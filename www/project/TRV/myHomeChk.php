<?
session_start(); 
if(!isset($_REQUEST['userNum'])) {
    $_SESSION['goUserNum'] = $_SESSION['loginNum'];
}else{
    $_SESSION['goUserNum'] = $_REQUEST['userNum'];
}
?>
<script>
    location.href = "myHome.php";
</script>