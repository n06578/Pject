<?
session_start(); 
if(!isset($_REQUEST['userNum'])) {
    $_SESSION['goUserNum'] = $_SESSION['loginNum'];
    $_SESSION['viewType'] = "home";
}else{
    $_SESSION['goUserNum'] = $_REQUEST['userNum'];
    $_SESSION['viewType'] = $_REQUEST['viewType'];
}
?>
<script>
    location.href = "myHome.php";
</script>