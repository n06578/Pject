<!--
header.php에서 col-xl-4로 설정되어있음
기본 col-xl-4
변경할 page : MyCal.php - col-xl-3
-->
<?
// 메인과 카테를 벗어날 경우 session 초기화
if($baseName[0] == "trvmain2"){
    $cardItemCol = "col-xl-4";
    $cardChkShow = "d-none";
}
?>
<?$cardItemCol = @$cardItemCol =="" ? "col-xl-4":$cardItemCol;?>
<div class="<?=$cardItemCol?> col-md-6 mb-4">
    <div class="showChkBox text-right <?=$cardChkShow?>">
        <input type="checkbox" class="form-check-input itemChkBox" id="checkItem<?=$mainSeq?>" name="checkItem[]" value="<?=$mainSeq?>">
    </div>
    <div class="card h-500 py-2 c-pointer listItemCard">
        <div class="card-body listItem p-2">
            <?
            $contentCss= "listItemMoreCon ";
            if($cnt_file > 0){
                $contentCss= "listItemCon ";
            ?>
            <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                <img class="listItemImg" src="<?=$srcItem?>">
                
                <div class="itemBigView text-right tx-10">
                    크게보기
                </div>
            </div>
            <?}?>
            <div class="<?=$contentCss?> pt-2" onclick="location.href='cateItemView.php?seq=<?=$mainSeq?>'" title="<?=$contentsItem?>">
                <?=$contentsItem?>
                <div class="listItemWrt text-right tx-10">
                    <?=$nameItem?>
                </div>
                <div class="showDetail text-right tx-10" onclick="location.href='trvView.php'">
                    자세히보기
                </div>
            </div>
        </div>
    </div>
</div>