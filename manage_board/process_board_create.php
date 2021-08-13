<?php
require_once '../db.class.php';

$sql = "
    INSERT INTO board
        (board_title, board_content, created, author_id)
        VALUES (
                :board_title,
                :board_content,
                NOW(),
                :author_id
        )
";

$article = array(   // 입력 필터링
    'board_title'       => htmlspecialchars($_POST['board_title']),
    'board_content'     => htmlspecialchars($_POST['board_content']),
    'author_id'         => htmlspecialchars($_POST['author_id'])
);

$result = DB::query($sql, array(
    ':board_title'      => $article['board_title'],
    ':board_content'    => $article['board_content'],
    ':author_id'        => $article['author_id']
));

// redirection
header('Location: ../index.php');