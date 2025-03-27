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
                <div class="listItemCon pt-2" onclick="location.href='cateItemView.php?seq=<?=$row_sub['itemSeq']?>'" title="<?=$row_sub['itemComment']?>">
                <?=$row_sub['itemComment']?>
                    <div class="listItemWrt text-right tx-10">
                        <?=getName($row_sub['joinSeq'])?>
                    </div>
                    <div class="showDetail text-right tx-10" onclick="location.href='trvView.php'">
                        자세히보기
                    </div>
                </div>
            </div>
        </div>
    </div>
<?} if($cnt_sub == 0 ){?>
    <div class="col-12 text-center tx-16 mt-1 mb-5">등록된 게시물이 없습니다.</div>
    <hr>
<?} ?>