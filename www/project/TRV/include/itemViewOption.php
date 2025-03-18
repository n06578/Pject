<?
$type = $num_file;
$itemComment = str_replace(" ", "", $itemComment);
if($itemComment !=""){
    if($num_file > 1 ){ $type = "1"; } // 이미지 여러장 출력
    else if($num_file == 1 ){$type = "2";} // 이미지 한장 출력
    else if($num_file == 0){$type = "3";} // 이미지 없음
}else if($num_file > 0 && $itemComment =="" ){$type = "4";} // 이미지 없음
?>
<div class="contentsOne">
    <div class="content-cate"><input type="button" class="btn btn-sm btn-navy" data-seq="<?=$subSeq?>" value="<?=$itemType?>"></div>
        <div class="content-div">
<?
switch($type){
    case "1":?>
            <div class="x-scroll my-2"> <?
                while($row_file = mysql_fetch_array($res_file)){?>
                    <img class="dItemImg c-pointer ml-1 modal-open" data-bs-toggle="modal" data-bs-target="#imgModal" src="<?=$row_file['filePath']?>">
            <? } ?>
            </div>
            <br>
            <text><?=nl2br($itemComment)?></text> <?
        break;
    case "2":?>
        <div class="x-scroll my-2"> <?
        while($row_file = mysql_fetch_array($res_file)){?>
            <img class="dItemImg c-pointer ml-1 modal-open" data-bs-toggle="modal" data-bs-target="#imgModal"  src="<?=$row_file['filePath']?>">
    <? } ?>
    </div>
            <text><?=nl2br($itemComment)?></text>
            <?
        break;
    case "3":
            ?>
            <text><?=nl2br($itemComment)?></text>
            <?
        break;
    case "4":
        while($row_file = mysql_fetch_array($res_file)){?>
            <img class="dItemImg c-pointer ml-1 modal-open" data-bs-toggle="modal" data-bs-target="#imgModal"  src="<?=$row_file['filePath']?>">
        <? } 
        break;
}
?>

    </div>
</div>