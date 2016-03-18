<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/global.php");

session_unset();
session_destroy();
$_SESSION = array();
unset($dados);
header('Location: /index.php');
