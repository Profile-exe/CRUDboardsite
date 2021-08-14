<?php
require_once '../db.class.php';

$board_id = $_GET['id'];
$is_integer = settype($board_id, 'integer');

$result = null;
if ($is_integer) {  // 정수는 true 반환됨
    try {
        $sql = "
            SELECT board_id, board_title, board_content, created, view_count, user_name FROM board
            INNER JOIN user ON board.user_id = user.user_id
            WHERE board_id = :board_id;
        ";

        $result = DB::query($sql, array(
            ':board_id' => $board_id
        ));

        if ($result == array()) {
            header('Location: ../index.php?msg=Wrong board ID');
        }

        $article = $result[0];
    } catch (Exception $e) {
        header('Location: ../index.php?msg=Error occurred while reading board');
    }
} else {
    header('Location: ../index.php?msg=Error occurred while reading board');
}
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DDING BOARD</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container my-3 d-flex justify-content-center">
    <div class="col-10">
        <header class="my-4">
            <h1 class="text-center">DDING BOARD</h1>
        </header>
        <section>
            <div class="borard_header">
                <div class="board_id" style="font-size:2em; color:gray;">
                    # <?=$article['board_id']?>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="board_title d-flex align-items-end" style="font-size:1.7em; color:black;">
                        <?=$article['board_title']?>
                    </div>
                    <div class="board_info">
                        <div class="author_name" style="font-weight:bold;">
                            <?=$article['user_name']?>
                        </div>
                        <div class="created">
                            <?=$article['created']?>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="board_body mb-5">
                <div class="board_content" style="font-size:1.5em; color:black;">
                    <?=$article['board_content']?>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="../index.php" class="btn btn-outline-secondary">돌아가기</a>
            </div>
        </section>
    </div>
</div>
<!--Bootstrap-->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
