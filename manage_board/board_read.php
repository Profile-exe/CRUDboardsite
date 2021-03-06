<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/delete_parameter.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 메시지 전달 시 알림
if (isset($_GET['msg'])) {
    echo '<script>alert("'.$_GET['msg'].'");</script>';
}

$redirect = '/index.php';
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != 'http://localhost/manage_member/register.php') {
    $redirect = delete_parameter($_SERVER['HTTP_REFERER'], 'msg');
}

$board_id = $_GET['id'];
$is_integer = settype($board_id, 'integer');

$result = null;
$article = null;
if ($is_integer) {  // 정수는 true 반환됨
    try {
        $sql = "
            SELECT * FROM board
            INNER JOIN user ON board.user_id = user.user_id
            WHERE board_id = :board_id;
        ";

        $result = DB::query($sql, array(
            ':board_id' => $board_id
        ));

        if ($result == array()) {
            exit(header('Location: /index.php?msg=Wrong_board_ID'));
        }

        $article = $result[0];

        $is_count = false;
        if (!isset($_COOKIE["board_{$board_id}"])) {    // 쿠키가 없는 경우 생성 후 조회수 증가
            setcookie("board_{$board_id}", $board_id, time() + 60 * 60 * 24);
            $is_count = true;
        }

        if ($is_count) {
            $sql = "
                UPDATE board SET
                    view_count = view_count + 1
                WHERE board_id = :id
            ";

            $result = DB::query($sql, array(
                ':id' => $board_id
            ));

            if ($result == 0) {    // UPDATE는 변경된 row의 개수 반환
                exit(header('Location: /index.php?msg=Wrong_board_ID'));
            }
        }
    } catch (Exception $e) {
        exit(header('Location: /index.php?msg=Error_occurred_while_reading_board'));
    }
} else {
    exit(header('Location: /index.php?msg=Error_occurred_while_reading_board'));
}

$loginout = '';
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $loginout = '<a id="loginout_btn" href="/manage_member/process_logout.php" class="btn btn-secondary">로그아웃</a>';
} else {
    $loginout = '<a id="loginout_btn" href="/manage_member/login.php" class="btn btn-secondary">로그인</a>';
}

$delete_btn = '';
$update_btn = '';
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '' || $_SESSION['user_id'] != $article['user_id']) {
    $delete_btn = '<div></div>';
    $update_btn = '<div></div>';
} else {
    $update_btn = "<a href=\"board_update.php?id={$article['board_id']}\" class=\"btn btn-outline-primary\">수정</a>";
    $delete_btn = "<a href=\"process_board_delete.php?id={$article['board_id']}\" class=\"btn btn-outline-danger\">삭제</a>";
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
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container my-3 d-flex justify-content-center">
    <div class="col-10">
        <header class="my-4">
            <nav class="navbar navbar-light">
                <div class="container-fluid px-0 d-flex justify-content-between">
                    <a href="/index.php" class="navbar-brand py-0" style="font-weight: bold; font-size: 2em">DDING BOARD</a>
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
        <article>
            <section class="borard_header">
                <div class="board_id mb-3 d-flex justify-content-between align-items-baseline">
                    <span style="font-size:2em; color:gray;"># <?=$article['board_id']?> - <?=$article['board_title']?></span>
                </div>
                <div class="board_info d-flex justify-content-between align-items-center">
                    <div class="author_name">
                        <span style="font-weight: bold;">Author |</span>
                        <?=$article['user_name']?>
                    </div>
                    <div class="created">
                        <span style="font-weight: bold;">View / Created |</span>
                        <?=$article['view_count']?> / <?=$article['created']?>
                    </div>
                </div>
            </section>
            <hr>
            <section class="board_body mb-5">
                <div class="board_content" style="font-size:1.2em; color:black;">
                    <?=$article['board_content']?>
                </div>
            </section>
            <hr>
            <section class="board_footer">
                <div class="board_modify_info d-flex justify-content-start mb-3">
                    <div class="last_update">
                        <span style="font-weight: bold;">Last Update |</span>
                        <?=$article['updated']?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <?=$update_btn?>
                        <?=$delete_btn?>
                    </div>
                    <a href="<?=$redirect?>" class="btn btn-outline-secondary">돌아가기</a>
                </div>
            </section>
        </article>
    </div>
</div>
<!--member_info modal-->
<div id="info_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script src="/js/member_info.js"></script>
<script src="/js/dropdown_loginout.js"></script>
<!--Bootstrap-->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
