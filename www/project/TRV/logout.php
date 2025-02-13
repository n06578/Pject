<?php
session_start();
$_SESSION['loginNum'] = '-';
$_SESSION['loginYn'] = "N";
?>
<script>
    location.href = "trvmain2.php";
</script>