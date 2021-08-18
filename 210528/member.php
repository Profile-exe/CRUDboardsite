<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['userId']) || $_SESSION['userId'] == '') {
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row m-5 justify-content-center">
                <div class="col-md-6">
                    <a href="./member-edit.php">정보수정</a>
                    <a href="./logout.php">로그아웃</a>
                    <a href="./member-leave.php">회원탈퇴</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>