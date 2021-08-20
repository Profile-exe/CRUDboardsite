<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

// 로그인체크
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 안했을 때 로그인 페이지로 redirect
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    exit(header("Location: /manage_member/login.php?msg=redirect_to_login"));
}

// POST 값 체크
if(isset($_POST['password']) && $_POST['password'] != '') {
    $id = $_SESSION['userId'];
    $password = $_POST['password'];
    $result = DB::query('SELECT * FROM user WHERE user_id=:id', array(':id' => $_SESSION['user_id']));

    // 비밀번호 체크
    if($result && count($result) > 0 && password_verify($password, $result[0]['user_password'])) {
        DB::query('DELETE FROM user WHERE user_id=:id', array(':id' => $_SESSION['user_id']));

        session_unset();
        session_destroy();
        exit(header('Location: /manage_member/login.php?msg=Member_withdrawal_completed'));
    }
    exit(header('Location: /index.php?msg=Wrong_password'));
}

header('Location: /index.php');