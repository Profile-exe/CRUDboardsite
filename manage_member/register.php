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
<div class="container">
    <div class="row m-5 justify-content-center">
        <div class="col-md-6">
            <div class="mb-3 text-center">
                <h1>회원가입</h1>
            </div>
            <form action="./member-insert.php" method="post">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" name="id" id="id" class="form-control" required/>
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
                    <input type="submit" value="회원가입" class="btn btn-primary"/>
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