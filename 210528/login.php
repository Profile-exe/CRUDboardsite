<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['userId']) && $_SESSION['userId'] != '') {
        header("Location: ./member.php");
    }

    if(isset($_GET['msg'])) {
        echo '<script>alert("'. $_GET['msg'] .'");</script>';
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
                <div class="mb-3 text-center">
                    <h1>로그인</h1>
                </div>
                <form action="./login-process.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" name="id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PASSWORD</label>
                        <input type="password" name="password" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="로그인" class="btn btn-primary"/>
                    </div>
                    <a href="./member-join.php">회원가입</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>