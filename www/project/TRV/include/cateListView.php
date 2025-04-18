<?
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
$where = "";
$_SESSION['cateSearch'] = "";
if (!in_array('전체보기', $_REQUEST['cate'])) {
    $where = " AND a.itemType IN ('" . implode("', '", $_REQUEST['cate']) . "')";
    $_SESSION['cateSearch'] = "'" . implode("', '", $_REQUEST['cate']) . "'";
}
$que_sub = "select a.*, b.joinSeq from TuserItemList a left join TuserItem b on a.itemSeq = b.seq where b.country = '".$_SESSION['searchCountry']."' $where group by b.seq order by b.writeDate desc";
$res_sub = mysql_query($que_sub);
$cnt_sub = mysql_num_rows($res_sub);
while($row_sub = mysql_fetch_array($res_sub)) {
    $que_file = "select * from TuserItemFile where itemSeq = '".$row_sub['itemSeq']."' and itemListSeq='".$row_sub['seq']."'";
    $res_file = mysql_query($que_file);
    $cnt_file = mysql_num_rows($res_file);
    $row_file = mysql_fetch_array($res_file);
    
    /* include에서 사용하는 변수 */
    $srcItem = ($cnt_file > 0)? $row_file['filePath']:"";
    $contentsItem = (@$row_sub['itemComment'] !="") ? nl2br($row_sub['itemComment']) : "";
    $nameItem = getName($row_sub['joinSeq']);
    $mainSeq = $row_sub['itemSeq'];
                        
    include "itemCardDiv.php";
} if($cnt_sub == 0 ){?>
    <div class="col-12 text-center tx-16 mt-1 mb-5">등록된 게시물이 없습니다.</div>
    <hr>
<?} ?>