<?
$where ="";
if(@$_REQUEST['search'] == "ajax") {
    session_start();
    $_SESSION['searchCountry'] = $_REQUEST['searchCountry'];
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';   
}

if(@$_REQUEST['search'] == "clear") {
    session_start();
    $_SESSION['searchCountry'] = "";
    $_SESSION["lat"]= "";
    $_SESSION["lng"]= "";
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';   
}
if(@$_REQUEST['pageName'] == "trvmain2" || @$_REQUEST['pageName'] == "mainCate") {
    $cardItemCol = "col-xl-4";
    $cardChkShow = "d-none";
}

if(@$_SESSION['searchCountry'] != "") {
    $where =" where  country like '".$_SESSION['searchCountry']."%'";
}
    $que_item = "select * from TuserItem $where order by writeDate desc";
    $res_item = mysql_query($que_item);
    $num_item = mysql_num_rows($res_item);
    while($row_item = mysql_fetch_array($res_item)) {
        $mainSeq = $row_item['seq'];
        $que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
        $res_sub = mysql_query($que_sub);
        $row_sub = mysql_fetch_array($res_sub);


        $que_file = "select * from TuserItemFile where itemSeq = '".$mainSeq."'";
        $res_file = mysql_query($que_file);
        $cnt_file = mysql_num_rows($res_file);
        $row_file = mysql_fetch_array($res_file);
        
        /* include에서 사용하는 변수 */
        $pageName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        $filePath = $row_file['filePath'];
        $srcItem = ($cnt_file > 0)? $filePath:"";
        $contentsItem = (@$row_sub['itemComment'] !="") ? nl2br($row_sub['itemComment']) : "";
        $nameItem = getName($row_item['joinSeq']);

        include "itemCardDiv.php";
    }
if($num_item < 1) {?>
    <div class="col-12 text-center tx-16 mt-1">등록된 게시물이 없습니다.</div>
<?}
if(@$_SESSION['searchCountry'] != "") {?>
    <div class="text-center" id="cateBtn"><i class="fas fa-arrow-up"></i> 카테고리로 보기</div>
<?}

?>

<script>
    $(document).ready(function() {
        $(".listItemWrt").addClass("d-none");
        $(".showDetail").addClass("d-none");
        $(".itemBigView").addClass("d-none");
        
    });
    $(".listItemBox").on({
        "mouseover":function() {
            $(this).find(".itemBigView").removeClass("d-none").addClass("d-flex");
        },
        "mouseout":function() {
            $(this).find(".itemBigView").removeClass("d-flex").addClass("d-none");
        }
    });

    $(".listItem").on({
        "mouseover":function() {
            $(this).find(".listItemWrt").removeClass("d-none").addClass("d-flex");
            $(this).find(".showDetail").removeClass("d-none").addClass("d-flex");
            
        },
        "mouseout":function() {
            $(this).find(".listItemWrt").removeClass("d-flex").addClass("d-none");
            $(this).find(".showDetail").removeClass("d-flex").addClass("d-none");
        }
    });
</script>