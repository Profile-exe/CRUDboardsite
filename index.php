<?php
require_once 'db.class.php';

// 세션 시작
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 메시지 전달 시 알림
if (isset($_GET['msg'])) {
    echo '<script>alert("'.$_GET['msg'].'");</script>';
}

$sql = "
    SELECT
        board_id, board_title, user_name, date_format(created, '%m-%d %H:%i') as created, view_count 
    FROM board INNER JOIN user
    ON board.user_id = user.user_id
    ORDER BY created DESC
    LIMIT 1000
";

$result = DB::query($sql);

$topic_list = '';
if ($result) {  // 글이 존재하는 경우 출력
    foreach ($result as $index => $row) {
        $topic_list .= "
            <tr style='cursor:pointer' onclick='location.href=\"/manage_board/board_read.php?id={$row['board_id']}\"'>
                <th class='col-1 text-center' scope='row'>{$row['board_id']}</th>
                <td class='col-7'>{$row['board_title']}</td>
                <td class='col-1 text-center'>{$row['user_name']}</td>
                <td class='col-2 text-center'>{$row['created']}</td>
                <td class='col-1 text-center'>{$row['view_count']}</td>
            </tr>
        ";
    }
}

$loginout = '';
$write_btn = '';
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $loginout = '<a id="loginout_btn" href="/manage_member/process_logout.php" class="btn btn-secondary">로그아웃</a>';
    $write_btn = '<a id="write_btn" href="/manage_board/board_create.php" class="btn btn-primary">글쓰기</a>';
} else {
    $loginout = '<a id="loginout_btn" href="/manage_member/login.php" class="btn btn-secondary">로그인</a>';
    $write_btn = '<button class="btn btn-primary" disabled>글쓰기</button>';
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

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container my-3 d-flex justify-content-center">
    <div class="col-10">
        <header class="my-4">
            <nav class="navbar navbar-light">
                <div class="container-fluid px-0 d-flex justify-content-between">
                    <a href="index.php" class="navbar-brand py-0" style="font-weight: bold; font-size: 2em">DDING BOARD</a>
                    <!-- Split dropstart button -->
                    <div class="btn-group">
                        <div class="btn-group dropstart" role="group">
                            <button type="button" id="dropdown-toggle" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropstart</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button id="info_btn" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#info_modal">내 정보</button></li>
                                <li><a class="dropdown-item" href="#">내가 쓴 글</a></li>
                            </ul>
                        </div>
                        <?=$loginout?>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <div class="col-12 d-flex justify-content-between mb-3">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <?=$write_btn?>
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
    <!--member_info modal-->
    <div id="info_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>
<script src="/js/member_info.js"></script>
<script src="/js/dropdown_loginout.js"></script>
<!--Bootstrap-->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>