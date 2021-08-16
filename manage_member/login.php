<?php
// 세션 시작
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 실패 등의 메시지 전달 시 알림
if (isset($_GET['msg'])) {
    echo '<script>alert("'.$_GET['msg'].'");</script>';
}

// 로그인 화면 전 이전페이지 기억
$return_page = '';
$previous_page = $_SERVER['HTTP_REFERER'];
if ($previous_page != 'process_login.php') {
    $return_page = $previous_page;
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
<div class="container">
    <div class="row m-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="mb-3 text-center">
                <h1>로그인</h1>
            </div>
            <form action="./process_login.php" method="post">
                <input type="hidden" name="return_page" value="<?=$return_page?>">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" name="id" id="id" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">PASSWORD</label>
                    <input type="password" name="password" id="password" class="form-control" required/>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <div>
                        <input type="submit" value="로그인" class="btn btn-primary"/>
                        <a href="./register.php" class="btn btn-secondary">회원가입</a>
                    </div>
                    <a href="../index.php" class="btn btn-outline-secondary">돌아가기</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Bootstrap-->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>