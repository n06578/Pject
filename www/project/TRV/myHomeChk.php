<?
session_start(); 
if(!isset($_REQUEST['userNum'])) {
    //내 게시물 관련
    $_SESSION['goUserNum'] = $_SESSION['loginNum'];
    $_SESSION['viewType'] = @$_REQUEST['viewType'];
}else{
    // 방문
    $_SESSION['goUserNum'] = $_REQUEST['userNum'];
    $_SESSION['viewType'] = "home";
}
?>
<script>
    location.href = "myHome.php";
</script>