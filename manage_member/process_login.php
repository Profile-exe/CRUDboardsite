<?php
require_once '../db.class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id']) && isset($_POST['password'])) {
    $user_id       = $_POST['id'];
    $user_password = $_POST['password'];

    $result = DB::query('SELECT * FROM user WHERE user_id = :user_id', array(':user_id' => $user_id));

    // 아이디와 비밀번호가 일치한다면
    if ($result && count($result) > 0 && password_verify($user_password, $result[0]['user_password'])) {
        $_SESSION['user_id']        = $user_id;
        $_SESSION['user_name']      = $result[0]['user_name'];
        $_SESSION['user_password']  = $user_password;

        DB::query('UPDATE user SET last_login = NOW() WHERE user_id=:user_id',array(':user_id' => $user_id));
        // 로그인 버튼을 누른 페이지로 이동
        header('Location: '.$_POST['return_page']);
    } else {
        // 로그인 실패 시 msg 전달
        header('Location: '.$_POST['return_page'].'?msg=Login_Failed');
    }
}