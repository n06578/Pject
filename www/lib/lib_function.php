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
        case "heart":
            $que = "select a.* from TuserItem a left join TanotherTbl b on a.seq = b.conSeq where 1=1 and b.joinSeq='".$_SESSION['loginNum']."' and b.type='heart' order by b.addDateTime desc ";
            break;
        case "cal":

        $que ="select a.itemSeq, b.* from (
                    select itemSeq, 
                        max(joinSeq) as joinSeq, 
                        max(calanSeq) as calanSeq, 
                        max(addDateTime) as addDateTime
                    from TcalanItemTbl
                    where joinSeq = '".$_SESSION['loginNum']."'
                    group by itemSeq
                ) a 
            left join TuserItem b on a.itemSeq = b.seq order by a.addDateTime desc ";
        break;
            
    }
    return $que;

}
?>