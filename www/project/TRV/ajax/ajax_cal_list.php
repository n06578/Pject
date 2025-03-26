<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');


$que = "select * from TcalanderTbl where joinSeq = '".$_SESSION['loginNum']."' order by startDateTime desc";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
$events = array();
while ($row = mysql_fetch_array($res)) {
    if($_REQUEST['type']=="item"){
        $que_chk = "select * from TcalanItemTbl where joinSeq='".$_SESSION['loginNum']."' and itemSeq='".$_REQUEST['conSeq']."' and calanSeq = '".$row['seq']."'";
        $res_chk = mysql_query($que_chk);
        $cnt_chk = mysql_num_rows($res_chk);
        $chk = $cnt_chk>0?"checked":"";
        ?>
        <tr>
            <td class="w-10"><input type="checkBox" name="calSeq[]" class="calSeq" value="<?=$row['seq']?>" <?=$chk?>></td>
            <td><?=$row['title']?></td>
            <td><?=substr($row['startDateTime'],0,10)?></td>
            <td><?=substr($row['endDateTime'],0,10)?></td>
        </tr>
    <?}else{
    // 데이터를 가공하여 배열에 저장
    $row['color'] = $row['color'] == "" ? "#0078D7":$row['color'];
    $event = array(
        'seq' => $row['seq'],           // 예시: '1'
        'start' => $row['startDateTime'],  // 예시: '2024-12-18 10:00:00'
        'end' => $row['endDateTime'],      // 예시: '2024-12-18 12:00:00'
        'title' => $row['title'],  // 예시: 'Conference'
        'subTitle' => $row['subTitle'],  // 예시: 'Conference'
        'allDay' => $row['allDay'], // 예시: 'true'
        'memo' => $row['contents'], // 예시: 'true'
        'color' => $row['color'],   // 예시: 'red'
        'console' => $row['color']   // 예시: 'red'
    );
    
    // events 배열에 추가
    $events[] = $event;}
}
if($_REQUEST['type']!="item"){
    // JSON 형식으로 출력
    header('Content-Type: application/json');
    echo json_encode($events);
}else{
    if($cnt == 0 ){
        echo "<tr><td class='text-center'colspan=4>등록된 일정이 없습니다.</td></tr>";
    }
}