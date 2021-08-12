<?php
require_once 'db.class.php';

$sql = "SELECT * FROM author";
$result = DB::query($sql);
$options = '';

foreach ($result as $index => $row) {
    $options .= '<option value="'.$row['author_id'].'">'.$row['author_name'].'</option>';
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
        <form class="mt-5" action="process_create.php" method="post">
            <div class="mb-3">
                <label for="select_author" class="form-label">작성자</label>
                <select class="form-select" id="select_author" name="author_id" aria-label="Default select example">
                    <?=$options?>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_board_title" class="form-label">글 제목</label>
                <input type="text" class="form-control" id="input_board_title" name="board_title" placeholder="제목을 입력하세요." required>
            </div>
            <div class="mb-3">
                <label for="input_board_content" class="form-label">글 내용</label>
                <textarea class="form-control" id="input_board_content" name="board_content" rows="10" placeholder="내용을 입력하세요." required></textarea>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <input type="submit" class="btn btn-primary">
                <a href="index.php" class="btn btn-secondary ms-2">취소</a>
            </div>
        </form>
    </section>
</div>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
</body>
</html>