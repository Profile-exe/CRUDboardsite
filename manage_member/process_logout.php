<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/delete_parameter.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
}

$redirect = '/index.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $redirect = delete_parameter($_SERVER['HTTP_REFERER'], 'msg');
}

header('Location: '.$redirect);
