<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

if (isset($_POST['id']) && isset($_POST['password']) && isset($_POST['name'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    try {
        $result = DB::query('INSERT INTO user VALUES (:id, :password, :name, DEFAULT, DEFAULT)', array(
            ':id'       => $id,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':name'     => $name
        ));
        header('Location: /manage_member/login.php?msg=register_succeeded');
    } catch (Exception $e) {
        header('Location: /manage_member/register.php?msg=error_occurred');
    }
} else {
    header('Location: /manage_member/register.php');
}