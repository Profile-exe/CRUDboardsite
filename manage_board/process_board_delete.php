<?php
require_once '../db.class.php';

// 로그인체크
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 안했을 때 로그인 페이지로 redirect
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    header("Location: ./login.php");
}

settype($_GET['id'], 'integer');
$result = DB::query('DELETE FROM board WHERE board_id=:id', array(
    ':id' => $_GET['id']
));

if ($result > 0) {
    header('Location: ../index.php');
} else {
    header('Location: ../index.php?msg=Error occurred while deleting board');
}

