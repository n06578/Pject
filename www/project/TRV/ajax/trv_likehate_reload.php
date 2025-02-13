<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

$que_lh = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and conType = '".$_REQUEST['conType']."'";
$res_lh = mysql_query($que_lh);
$cnt_lh = mysql_num_rows($res_lh);

$likeChk = $hateChk = "far";
if($cnt_lh>0){
    $row_lh  = mysql_fetch_array($res_lh);
    $row_lh['likeHate'] == "like"?  $likeChk = "fas": $hateChk = "fas";
}
?>
    <label class="c-pointer ansLikeCnt mr-1"><i class="<?=$likeChk?> fa-thumbs-up"></i> <?=getAnsCnt($_REQUEST['conSeq'],$_REQUEST['conType'],"like")?></label>
    <label class="c-pointer ansHateCnt mr-1"><i class="<?=$hateChk?> fa-thumbs-down"></i> <?=getAnsCnt($_REQUEST['conSeq'],$_REQUEST['conType'],"hate")?></label>
<? if($_REQUEST['joinSeq'] == $_SESSION['loginNum']){ ?>
    <label class="c-pointer deleteCnt"><i class="fas fa-trash-alt"></i></label>
<? } ?>