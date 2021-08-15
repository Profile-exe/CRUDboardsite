<?php
require_once '../db.class.php';

// 로그인체크
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 안했을 때 로그인 페이지로 redirect
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    header("Location: ./login.php");
}

$sql = "
    SELECT * FROM board
    WHERE board_id=:id
";

settype($_GET['id'], 'integer');
$result = DB::query($sql, array(
    ':id' => $_GET['id']
));

$article = array(
    'board_id'      => $result[0]['board_id'],
    'board_title'   => $result[0]['board_title'],
    'board_content' => $result[0]['board_content'],
    'user_id'       => $result[0]['user_id']
);

// id 값을 달리하여 이 파일에 접근하는 경우 게시글의 저자가 아니면 redirect
if ($_SESSION['user_id'] != $article['user_id']) {
    header('Location: ../index.php');
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
</head>
<body>
<div class="container my-3 d-flex justify-content-center">
    <div class="col-10">
        <header class="my-4">
            <h1 class="text-center">DDING BOARD</h1>
        </header>
        <section>
            <form class="mt-5" action="process_board_update.php" method="post">
                <input type="hidden" name="board_id" value="<?=$article['board_id']?>">
                <div class="mb-3">
                    <label for="input_board_title" class="form-label">글 제목</label>
                    <input type="text" class="form-control" id="input_board_title" name="board_title" value="<?=$article['board_title']?>" placeholder="제목을 입력하세요." required>
                </div>
                <div class="mb-3">
                    <label for="input_board_content" class="form-label">글 내용</label>
                    <textarea class="form-control" id="input_board_content" name="board_content" style="resize: none;" rows="11" placeholder="내용을 입력하세요." required><?=$article['board_content']?></textarea>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" value="수정">
                    <a href="../index.php" class="btn btn-secondary ms-2">취소</a>
                </div>
            </form>
        </section>
    </div>
</div>
<!--Bootstrap-->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>