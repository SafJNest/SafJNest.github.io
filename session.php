<?php
session_start();

$_SESSION['id'] = $_POST['id'];
$_SESSION['tokenType'] = $_POST['tokenType'];
$_SESSION['accessToken'] = $_POST['accessToken'];

?>