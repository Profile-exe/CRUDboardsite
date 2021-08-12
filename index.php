<?php
require_once 'db.class.php';

$sql = "
    SELECT
        board_id, board_title, author_name, date_format(created, '%m-%d') as created, view_count 
    FROM board LEFT JOIN author
    ON board.author_id = author.author_id
";

$result = DB::query($sql);

$topic_list = '';
if ($result) {  // 글이 존재하는 경우 출력
    foreach ($result as $index => $row) {
        $topic_list .= "
        <tr class=''>
            <th class='col-1 text-center' scope='row'>{$row['board_id']}</th>
            <td class='col-8'>{$row['board_title']}</td>
            <td class='col-1 text-center'>{$row['author_name']}</td>
            <td class='col-1 text-center'>{$row['created']}</td>
            <td class='col-1 text-center'>{$row['view_count']}</td>
        </tr>
    ";
    }
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container mt-3 mb-3">
    <header>
        <nav class="navbar mb-3"></nav>
        <h1 class="text-center">DDING BOARD</h1>
    </header>
    <section>
        <div class="col-12 d-flex justify-content-end mb-3">
            <a href="create_board.php" class="btn btn-primary">글쓰기</a>
        </div>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th scope="col">제목</th>
                    <th class="text-center" scope="col">글쓴이</th>
                    <th class="text-center" scope="col">작성일</th>
                    <th class="text-center" scope="col">조회수</th>
                </tr>
            </thead>
            <tbody>
                <?=$topic_list?>
            </tbody>
        </table>
    </section>
</div>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
</body>
</html>