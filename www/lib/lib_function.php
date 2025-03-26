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

function HomeViewWhere($mode,$user){
    $Where = "";
    switch($mode){
        case "home":
            $Where = " and joinSeq ='".$user."' ";
            break;
        case "recent":
            $Where = "  and seq in (select conSeq from TanotherTbl where joinSeq='".$_SESSION['loginNum']."' and type='recent')";
            break;
        case "save":
            $Where = " and 3=3 ";
            break;
        case "cal":
            $Where = " and 4=4 ";
            break;
    }
    return $Where;

}
?>