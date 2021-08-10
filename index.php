<?php
require_once 'db.class.php';

$sql = 'SELECT * FROM board';
$result = DB::query($sql);

$topic_list = '';
foreach ($result as $index => $row) {
    $topic_list .= "
        <tr>
            <th scope=\"row\">{$index}</th>
            <td>{$row['board_title']}</td>
            <td>{$row['board_content']}</td>
            <td>{$row['created']}</td>
        </tr>
    ";
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
        <h1 class="text-center">게시판</h1>
    </header>
    <section>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">제목</th>
                    <th scope="col">저자</th>
                    <th scope="col">만든 날짜</th>
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