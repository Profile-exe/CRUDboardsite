<?php
    require_once 'db.class.php';

    // 회원가입
    if(isset($_POST['id']) && isset($_POST['password']) && isset($_POST['name'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $name = $_POST['name'];

        $result = DB::query('SELECT * FROM wl0004 WHERE id=' . $id);
        
        if(count($result) > 0) {
            header('Location: ./member-join.php?msg=중복된 아이디');
        } else {
            DB::query('INSERT INTO wl0004 VALUES (:id, :password, :name)', array(
                ':id'          => $id,
                ':password'    => password_hash($password, PASSWORD_DEFAULT),
                ':name'        => $name
            ));
            header('Location: ./login.php?msg=회원가입 성공');
        }
    } else {
        header('Location: ./member-join.php');
    }
?>