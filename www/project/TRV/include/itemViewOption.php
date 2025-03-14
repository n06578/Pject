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
    case "1":
            while($row_file = mysql_fetch_array($res_file)){?>
                <img class="dItemImg" src="<?=$row_file['filePath']?>">
            <? } ?>
            <br>
            <text><?=$itemComment?></text> <?
        break;
    case "2":
        while($row_file = mysql_fetch_array($res_file)){?>
            <img class="dItemImg" src="<?=$row_file['filePath']?>">
        <? } ?>
            <text><?=$itemComment?></text>
            <?
        break;
    case "3":
            ?>
            <text><?=$itemComment?></text>
            <?
        break;
    case "4":
        while($row_file = mysql_fetch_array($res_file)){?>
            <img class="dItemImg" src="<?=$row_file['filePath']?>">
        <? } 
        break;
}
?>

    </div>
</div>