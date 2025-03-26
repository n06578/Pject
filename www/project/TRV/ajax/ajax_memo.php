<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');


$dataMode = @$_REQUEST['dataMode'] != "" ? $_REQUEST['dataMode'] : "insertChk";
$seq = @$_REQUEST['seq'] != "" ? $_REQUEST['seq'] : "";

if($dataMode == "delData"){
    $que = "delete from TcalanderTbl where seq='".$_REQUEST['seq']."' and joinSeq = '".$_SESSION['loginNum']."'";
    mysql_query($que);
    exit;
}

if($seq == ""){
    $_REQUEST['color'] = @$_REQUEST['color'] =="" ? "":$_REQUEST['color'];
    
    // 날짜 데이터 변환 처리
    $start = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['start']);
    $startDate = date("Y-m-d H:i:s", strtotime($start));
    
    $end = preg_replace('/\s*\(.*\)$/', '', $_REQUEST['end']);
    $endDate = date("Y-m-d H:i:s", strtotime($end));

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
            where seq='".$_REQUEST['seq']."' and joinSeq = '".$_SESSION['loginNum']."'";
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
    
    $que_item = "select * from TcalanItemTbl where  calanSeq='".$seq."' order by addDateTime desc";
    $res_item = mysql_query($que_item);
    $row_item = mysql_fetch_array($res_item);
    
    $que_item = "select * from TuserItem where 1=1 and seq ='".$row_item['itemSeq']."'";
    $res_item = mysql_query($que_item);
    $row_item = mysql_fetch_array($res_item);

    $que_sub = "select * from TuserItemList where itemSeq = '".$row_item['seq']."'";
    $res_sub = mysql_query($que_sub);
    $row_sub = mysql_fetch_array($res_sub);


    $que_file = "select * from TuserItemFile where itemSeq = '".$row_item['seq']."'";
    $res_file = mysql_query($que_file);
    $row_file = mysql_fetch_array($res_file);

    $data['card'] = 
    '<div class="card-body listItem p-2">
        <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
            <img class="listItemImg" src="'.$row_file['filePath'].'">
            
            <div class="itemBigView text-right txt-7">
                크게보기
            </div>
        </div>
        <div class="listItemCon pt-2" onclick="location.href=\'itemView.php?seq='.$row_item['seq'].'\'" title="'.$row_sub['itemComment'].'">
            '.$row_sub['itemComment'].'
            <div class="showDetail text-right txt-6">
                자세히보기
            </div>
        </div>
    </div>';

?>

<?echo json_encode($data);?>