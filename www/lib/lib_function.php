<?php
function getName($joinSeq){
    $que = "select nickName from TjoinTbl where seq = '".$joinSeq."'";
    $res = mysql_query($que);
    $row = mysql_fetch_array($res);
    
    return $row[0];
}

function getAnsCnt($conSeq,$conType,$likeHate){
    $que = "select * from TlikeHateTbl where conSeq='".$conSeq."' and conType='".$conType."' and likeHate='".$likeHate."'";
    $res = mysql_query($que);
    $cnt = mysql_num_rows($res);

    return $cnt;
}
?>