<?php
    require_once 'db.class.php';

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['id']) && isset($_POST['password'])) {
        $userId = $_POST['id'];
        $userPw = $_POST['password'];

        $result = DB::query('SELECT * FROM wl0004 WHERE id = "' .$userId . '"');

        if($result && count($result) > 0 && password_verify($userPw, $result[0]['password'])) {
            $_SESSION['userId'] = $userId;
            $_SESSION['userName'] = $result[0]['name'];
            header('Location: ./member.php');
        } else {
            header('Location: ./login.php?msg=로그인실패');
        }
    } else {
        header('Location: ./login.php?msg=로그인실패');
    }

?>