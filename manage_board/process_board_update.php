<?php
require_once '../db.class.php';

$sql = "
    UPDATE board SET
        board_title = :title,
        board_content = :content
        WHERE board_id = :board_id
";

$article = array(   // 입력 필터링
    'board_title'      => htmlspecialchars($_POST['board_title']),
    'board_content'    => htmlspecialchars($_POST['board_content']),
    'board_id'         => htmlspecialchars($_POST['board_id'])
);

$result = DB::query($sql, array(
    ':title'           => $article['board_title'],
    ':content'         => $article['board_content'],
    ':board_id'        => $article['board_id']
));

if ($result > 0) {
    header("Location: board_read.php?id={$article['board_id']}");
} else {
    header("Location: board_read.php?id={$article['board_id']}&msg=Error occurred while updating board");
}