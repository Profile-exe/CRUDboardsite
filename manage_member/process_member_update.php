<?php
require_once '../db.class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    exit(header('Location: ../index.php?msg=Wrong_approach'));
}

$sql = 'UPDATE user SET user_name = :name WHERE user_id = :id';

$article = array(   // 입력 필터링
    'id'   => $_SESSION['user_id'],
    'name' => htmlspecialchars($_POST['user_name'])
);

$result = DB::query($sql, array(
    ':name' => $article['name'],
    ':id'   => $article['id']
));

if ($result > 0) {
    header("Location: ../index.php?Location={$_SERVER['DOCUMENT_ROOT']}");
} else {
    header("Location: ../index.php?msg=Error_occurred_while_updating_user_information");
}