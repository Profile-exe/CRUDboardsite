<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

// 세션 시작
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 안했을 때 로그인 페이지로 redirect
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    exit(header("Location: /manage_member/login.php"));
}

$post_data = json_decode(file_get_contents('php://input'));

if ($post_data->password == '') die('false'); // 빈 입력은 false 반환

$result = null;
try {
    $result = DB::query('SELECT * FROM user WHERE user_id=:user_id', array(
        ':user_id' => $_SESSION['user_id']
    ));
} catch (Exception $e) {
    // 쿼리에서 에러 발생 시 false로 처리
    die('false');
}

if (count($result) > 0 && password_verify($post_data->password, $result[0]['user_password'])) {
    echo 'true';
} else {
    echo 'false';
}
