<?php
session_start();
$_SESSION["area1"]= $_REQUEST["area1"];
$_SESSION["area2"]= $_REQUEST["area2"];
$_SESSION["area3"]= $_REQUEST["area3"];

$_SESSION["lat"]= $_REQUEST["lat"];
$_SESSION["lng"]= $_REQUEST["lng"];

echo $_SESSION["area1"].$_SESSION["area2"].$_SESSION["area3"];
?>