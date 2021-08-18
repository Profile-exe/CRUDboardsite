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
                    <div class="mb-3 text-center">
                        <h1>정보수정</h1>
                    </div>
                    <form action="./member-update.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" name="id" class="form-control" value="<?= $_SESSION['userId'] ?>" disabled required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CURRENT PASSWORD</label>
                            <input type="password" name="password" class="form-control" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NEW PASSWORD</label>
                            <input type="password" name="new-password" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NAME</label>
                            <input type="text" name="name" class="form-control" value="<?= $_SESSION['userName'] ?>"  required/>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="수정" class="btn btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>