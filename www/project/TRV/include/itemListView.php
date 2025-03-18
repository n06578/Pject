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

if(@$_SESSION['searchCountry'] != "") {
    $where =" where  country = '".$_SESSION['searchCountry']."'";
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
        $row_file = mysql_fetch_array($res_file);
    ?>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-500 py-2 c-pointer listItemCard">
            <div class="card-body listItem p-2">
                <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                    <img class="listItemImg" src="<?=$row_file['filePath']?>">
                    
                    <div class="itemBigView text-right tx-10">
                        크게보기
                    </div>
                </div>
                <div class="listItemCon pt-2" onclick="location.href='itemView.php?seq=<?=$mainSeq?>'" title="<?=$row_sub['itemComment']?>">
                <?=$row_sub['itemComment']?>
                    <div class="listItemWrt text-right tx-10">
                        <?=getName($row_item['joinSeq'])?>
                    </div>
                    <div class="showDetail text-right tx-10" onclick="location.href='trvView.php'">
                        자세히보기
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}
if($num_item < 1) {?>
    <div class="col-12 text-center tx-16 mt-1">등록된 게시물이 없습니다.</div>
<?}
if(@$_SESSION['searchCountry'] != "") {?>
    <div class="text-center" id="cateBtn"><i class="fas fa-arrow-up"></i> 카테고리로 보기</div>
<?}?>