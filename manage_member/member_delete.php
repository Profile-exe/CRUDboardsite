<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 로그인 없이 접근한 경우
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
    exit(header('Location: /index.php?msg=Wrong_approach'));
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
<div class="container">
    <div class="row m-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="mb-3 text-center">
                <h1>회원탈퇴</h1>
            </div>
            <form id="withdrawal_form" action="/manage_member/process_member_delete.php" method="post">
                <div id="passwd_verification" class="needs-validation mb-3">
                    <label for="passwd" class="form-label">PASSWORD</label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwd" class="form-control" required/>
                        <button type="button" id="passwd_check_btn" class="btn btn-secondary">비밀번호 확인</button>
                    </div>
                    <div class="valid-feedback id-feedback">올바른 비밀번호 입니다.</div>
                    <div class="invalid-feedback id-feedback">잘못된 비밀번호 입니다.</div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <input type="submit" value="탈퇴" id="register-btn" class="btn btn-outline-danger"/>
                    <a href="/index.php" class="btn btn-outline-secondary">돌아가기</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/lib/change_valid_status.js"></script>
<script src="/js/password_verification.js"></script>
<!--Bootstrap-->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>