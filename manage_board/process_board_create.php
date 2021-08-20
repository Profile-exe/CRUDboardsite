<?php
require_once '../classes/db.class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "
    INSERT INTO board
        (board_title, board_content, created, user_id, updated)
        VALUES (
                :board_title,
                :board_content,
                NOW(),
                :user_id,
                NOW()
        )
";

$article = array(   // 입력 필터링
    'board_title'       => htmlspecialchars($_POST['board_title']),
    'board_content'     => htmlspecialchars($_POST['board_content']),
    'user_id'           => htmlspecialchars($_SESSION['user_id'])
);

$result = DB::query($sql, array(
    ':board_title'      => $article['board_title'],
    ':board_content'    => $article['board_content'],
    ':user_id'          => $article['user_id']
));

$result = DB::query('
    UPDATE user 
        SET board_count = board_count + 1 
        WHERE user_id = :user_id',
        array(':user_id' => $article['user_id'])
);

// redirection
header('Location: /index.php');