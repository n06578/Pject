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
    $que = "";
    switch($mode){
        case "home":
            $que = "select * from TuserItem where 1=1 and joinSeq ='".$user."' order by writeDate desc";
            break;
        case "recent":
            $que = "select a.* from TuserItem a left join TanotherTbl b on a.seq = b.conSeq where 1=1 and b.joinSeq='".$_SESSION['loginNum']."' and b.type='recent' order by b.addDateTime desc ";
            break;
        case "save":
            $que = " and 3=3 ";
            break;
        case "cal":
            $que = " and 4=4 ";
            break;
    }
    return $que;

}
?>