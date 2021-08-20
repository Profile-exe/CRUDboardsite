<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 없이 접근한 경우
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    exit(header('Location: /index.php?msg=Wrong_approach'));
}

// 변경할 이름 값을 안넣은 경우
if (!isset($_POST['user_name']) || $_POST['user_name'] === '') {
    exit(header('Location: /index.php?msg=Input_empty_name'));
} else if ($_POST['user_name'] === $_SESSION['user_name']) {
    exit(header('Location:'.$_POST['return_page']));
}

$sql = 'UPDATE user SET user_name = :name WHERE user_id = :id';

$article = array(   // 입력 필터링
    'name' => htmlspecialchars($_POST['user_name']),
    'id'   => $_SESSION['user_id']
);

$result = DB::query($sql, array(
    ':name' => $article['name'],
    ':id'   => $article['id']
));

header('Location:'.$_POST['return_page']);