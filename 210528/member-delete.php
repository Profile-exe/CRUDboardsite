<?php
    require_once 'db.class.php';
    
    // 로그인체크
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['userId']) || $_SESSION['userId'] == '') {
        header("Location: ./login.php");
    }

    // POST 값 체크
    if(isset($_POST['password']) && $_POST['password'] != '') {
        $id = $_SESSION['userId'];
        $password = $_POST['password'];
        $result = DB::query('SELECT * FROM wl0004 WHERE id="' . $id . '"');

        // 비밀번호 체크
        if($result && count($result) > 0 && password_verify($password, $result[0]['password'])) {

            DB::query('DELETE FROM wl0004 WHERE id="' . $id . '"');

            session_unset();
            session_destroy();
            header('Location: ./login.php?msg=회원탈퇴완료');
        }
        header('Location: ./member.php?msg=비밀번호틀림');
    }

    header('Location: ./member.php');
?>