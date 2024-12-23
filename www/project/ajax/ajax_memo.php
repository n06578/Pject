<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');


$dataMode = $_REQUEST['dataMode'] != "" ? $_REQUEST['dataMode'] : "insertChk";

if($dataMode == "insertChk"){
    $que = "select * from MonthMemo where memoId='".$_REQUEST['id']."'";
    $res = mysql_query($que) or die(mysql_error());
    $row = mysql_fetch_array($res);
    $cnt = mysql_num_rows($res);
    
    // 날짜 데이터 변환 처리
    $start = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['start']);;
    $startDate = date("Y-m-d H:i:s", strtotime($start));
    
    $end = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['end']);;
    $endDate = date("Y-m-d H:i:s", strtotime($end));
    
    
    if($cnt == 0){
        $que = "insert into MonthMemo set
                    memoId='".$_REQUEST['id']."',
                    allDay = '".$_REQUEST['allDay']."',
                    endDate = '".$endDate."',
                    startDate = '".$startDate."',
                    color = '".$_REQUEST['color']."',
                    title = '".$_REQUEST['title']."'
                    ";
        mysql_query($que);
    }else{
        $que = "update MonthMemo set
                    allDay = '".$_REQUEST['allDay']."',
                    color = '".$_REQUEST['color']."',
                    title = '".$_REQUEST['title']."'
                where memoId='".$_REQUEST['id']."'
                    ";
        mysql_query($que);
    }

    $que = "select * from MonthMemo where memoId='".$_REQUEST['id']."'";
    $res = mysql_query($que) or die(mysql_error());
    $row = mysql_fetch_array($res);

    $data['allDay'] = $row['allDay'];
    $data['endDate'] = $row['endDate'];
    $data['startDate'] = $row['startDate'];
    $data['color'] = $row['color'];
    $data['title'] = $row['title'];
    $data['memo'] = $row['memo'];
    echo json_encode($data);
    
}else if($dataMode == "updateData"){
    
    $_REQUEST['startDate'] = $_REQUEST['startDay']. " " . $_REQUEST['startTime'];
    $_REQUEST['endDate'] = $_REQUEST['endDay']. " " . $_REQUEST['endTime'];
    $que = "update MonthMemo set
                allDay = '".$_REQUEST['allDay']."',
                endDate = '".$_REQUEST['endDate']."',
                startDate = '".$_REQUEST['startDate']."',
                color = '".$_REQUEST['color']."',
                title = '".$_REQUEST['title']."',
                memo = '".$_REQUEST['memo']."'
            where memoId='".$_REQUEST['id']."'
                ";
    mysql_query($que);
}

?>