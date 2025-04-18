<?
session_start();
$_SESSION['cateView'] = $_REQUEST['cateView'];


if (isset($_REQUEST['cate']) && is_array($_REQUEST['cate'])) {
    // 빈 문자열 제거
    $filtered = array_filter($_REQUEST['cate'], function($val) {
        return trim($val) !== '';
    });

    $_SESSION['cateViewList'] = array_values($filtered); // 인덱스 정렬
}
?>