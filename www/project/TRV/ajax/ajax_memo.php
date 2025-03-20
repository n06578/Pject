<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');


$dataMode = $_REQUEST['dataMode'] != "" ? $_REQUEST['dataMode'] : "insertChk";
$seq = $_REQUEST['seq'] != "" ? $_REQUEST['seq'] : "";

if($dataMode == "delData"){
    $que = "delete from TcalanderTbl where seq='".$_REQUEST['seq']."' and joinSeq = '".$_SESSION['loginNum']."'";
    mysql_query($que);
    exit;
}

if($seq == ""){
    $_REQUEST['color'] = @$_REQUEST['color'] =="" ? "":$_REQUEST['color'];
    $que = "select * from TcalanderTbl where memoId='".$_REQUEST['id']."' and joinSeq = '".$_SESSION['loginNum']."'";
    $res = mysql_query($que) or die(mysql_error());
    $row = mysql_fetch_array($res);
    $cnt = mysql_num_rows($res);
    
    // 날짜 데이터 변환 처리
    $start = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['start']);
    $startDate = date("Y-m-d H:i:s", strtotime($start));
    
    $end = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['end']);
    $endDate = date("Y-m-d H:i:s", strtotime($end));
    
    
    if($cnt == 0){
        $que = "insert into TcalanderTbl set
                    memoId='".$_REQUEST['id']."',
                    joinSeq = '".$_SESSION['loginNum']."',
                    allDay = '".$_REQUEST['allDay']."',
                    endDateTime = '".$endDate."',
                    startDateTime = '".$startDate."',
                    title = '".$_REQUEST['title']."',
                    subTitle = '".$_REQUEST['subTitle']."',
                    contents = '',
                    color = '".$_REQUEST['color']."'
                    ";
        mysql_query($que);
        $seq = mysql_insert_id();
    }


    
}else if($seq != "" && $dataMode == "updateData"){
    
    $_REQUEST['startDateTime'] = $_REQUEST['startDay']. " " . $_REQUEST['startTime'];
    $_REQUEST['endDateTime'] = $_REQUEST['endDay']. " " . $_REQUEST['endTime'];
    $que = "update TcalanderTbl set
                allDay = '".$_REQUEST['allDay']."',
                endDateTime = '".$_REQUEST['endDateTime']."',
                startDateTime = '".$_REQUEST['startDateTime']."',
                color = '".$_REQUEST['color']."',
                title = '".$_REQUEST['title']."',
                subTitle = '".$_REQUEST['subTitle']."',
                contents = '".$_REQUEST['memo']."'
            where memoId='".$_REQUEST['id']."' and joinSeq = '".$_SESSION['loginNum']."'";
    mysql_query($que);
}
    $que = "select * from TcalanderTbl where seq='".$seq."' and joinSeq = '".$_SESSION['loginNum']."'";
    $res = mysql_query($que) or die(mysql_error());
    $row = mysql_fetch_array($res);

    $data['allDay'] = $row['allDay'];
    $data['endDate'] = $row['endDateTime'];
    $data['startDate'] = $row['startDateTime'];
    $data['color'] = $row['color'];
    $data['title'] = $row['title'];
    $data['subTitle'] = $row['subTitle'];
    $data['memo'] = $row['contents'];
    $data['seq'] = $seq;
    echo json_encode($data);
?>