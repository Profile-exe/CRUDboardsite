<?php
require_once '../db.class.php';

if (isset($_POST['id']) && isset($_POST['password']) && isset($_POST['name'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    try {
        $result = DB::query('INSERT INTO user VALUES (:id, :password, :name)', array(
            ':id'       => $id,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':name'     => $name
        ));
        header('Location: ./login.php?msg=register_succeeded');
    } catch (Exception $e) {
        header('Location: ./register.php?msg=error_occurred');
    }
} else {
    header('Location: ./register.php');
}