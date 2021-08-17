<?php
require_once '../db.class.php';

// 로그인체크
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 안했을 때 로그인 페이지로 redirect
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    exit(header("Location: ../manage_member/login.php?msg=redirect_to_login"));
}

settype($_GET['id'], 'integer');

$result = DB::query("SELECT * FROM board WHERE board_id=:id", array(
    ':id' => $_GET['id']
));

// id 값을 달리하여 이 파일에 접근하는 경우 게시글의 저자가 아니면 redirect
if ($_SESSION['user_id'] != $result[0]['user_id']) {
    exit(header('Location: ../index.php?msg=wrong_approach'));
}

$result = DB::query('DELETE FROM board WHERE board_id=:id', array(
    ':id' => $_GET['id']
));

if ($result > 0) {  // 성공적으로 제거 된 경우 board_count 1 감소
    $result = DB::query('
        UPDATE user
            SET board_count = board_count - 1
            WHERE user_id = :user_id',
            array(':user_id' => $_SESSION['user_id'])
    );
    header('Location: ../index.php');
} else {
    header('Location: ../index.php?msg=Error_occurred_while_deleting_board');
}

