<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');

$que = "select * from MonthMemo ";
$res = mysql_query($que);
$events = array();
while ($row = mysql_fetch_array($res)) {
    // 데이터를 가공하여 배열에 저장
    // $row['color'] = $row['color'] == "" ? "blue":$row['color'];
    $event = array(
        'seq' => $row['seq'], // 예시: 1
        'start' => $row['startDate'],  // 예시: '2024-12-18 10:00:00'
        'end' => $row['endDate'],      // 예시: '2024-12-18 12:00:00'
        'title' => $row['title'],  // 예시: 'Conference'
        'allDay' => $row['allDay'], // 예시: 'true'
        'memo' => $row['memo'], // 예시: 'true'
        'color' => $row['color']   // 예시: 'red'
    );

    // events 배열에 추가
    $events[] = $event;
}
// JSON 형식으로 출력
header('Content-Type: application/json');
echo json_encode($events);