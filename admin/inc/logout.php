<?php

$url = $_SERVER['HTTP_HOST'];
// echo $url;

ob_start();

session_start();
session_unset();
session_destroy();

header('Location: http://'.$url.'/newstoday/admin/');
ob_end_flush();
?>