<?php
require_once '../db.class.php';

$sql = "
    INSERT INTO board
        (board_title, board_content, created, user_id)
        VALUES (
                :board_title,
                :board_content,
                NOW(),
                :user_id
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

// redirection
header('Location: ../index.php');