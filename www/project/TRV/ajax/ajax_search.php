<?php
session_start();
$_SESSION["area1"]= $_REQUEST["area1"];
$_SESSION["area2"]= $_REQUEST["area2"];
$_SESSION["area3"]= $_REQUEST["area3"];


echo $_SESSION["area1"].$_SESSION["area2"].$_SESSION["area3"];
?>