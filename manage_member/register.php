<?php
// 회원가입 실패 등의 메시지 전달 시 알림
if (isset($_GET['msg'])) {
    echo '<script>alert("'.$_GET['msg'].'");</script>';
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
                <h1>회원가입</h1>
            </div>
            <form id="register_form" action="process_member_insert.php" method="post">
                <div id="input_id" class="needs-validation mb-3">
                    <label for="id" class="form-label">ID</label>
                    <div class="input-group">
                        <input type="text" name="id" id="id" class="form-control" required/>
                        <button type="button" id="duplicate_check_btn" class="btn btn-secondary">중복확인</button>
                    </div>
                    <div class="valid-feedback id-feedback">사용 가능한 아이디입니다.</div>
                    <div class="invalid-feedback id-feedback">사용 불가능한 아이디입니다.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">PASSWORD</label>
                    <input type="password" name="password" id="password" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">NAME</label>
                    <input type="text" name="name" id="name" class="form-control" required/>
                </div>
                <div class="mb-3">
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <input type="submit" value="회원가입" id="register-btn" class="btn btn-primary"/>
                    <a href="../index.php" class="btn btn-outline-secondary">돌아가기</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/duplicate_verification.js"></script>
<!--Bootstrap-->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>