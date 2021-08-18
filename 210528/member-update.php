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

            // 비밀번호 변경
            if(isset($_POST['new-password']) && $_POST['new-password'] != '') {

                $result = DB::query('UPDATE wl0004 SET name=:name, password=:password WHERE id=:id', array(
                    ':name'            => $_POST['name'],
                    ':password'        => password_hash($_POST['new-password'], PASSWORD_DEFAULT),
                    ':id'            => $id
                ));
            } else {
                // 이름만 변경
                $result = DB::query('UPDATE wl0004 SET name=:name WHERE id=:id', array(
                    ':name'            => $_POST['name'],
                    ':id'            => $id
                ));
            }

            $_SESSION['userName'] = $_POST['name'];
        }
    }

    header('Location: ./member.php');
?>