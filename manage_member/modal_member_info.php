<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/delete_parameter.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$redirect = '/index.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $_SERVER['HTTP_REFERER'] = delete_parameter($_SERVER['HTTP_REFERER'], 'msg');
    $redirect = $_SERVER['HTTP_REFERER'];
}

// CORS 허용
header("Access-Control-Allow-Origin: http://localhost:63342");
header("Access-Control-Allow-Credentials: true");

// 로그인이 안되어있으면 에러 모달 표시
if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    exit('
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            잘못된 접근입니다. 로그인 후 올바른 경로로 접근 바랍니다.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    ');
}

$result = DB::query('SELECT * FROM user WHERE user_id=:id', array(':id' => $_SESSION['user_id']))[0];

$info = array(
    'user_id'       => $result['user_id'],
    'user_name'     => $result['user_name'],
    'board_count'   => $result['board_count'],
    'last_login'    => $result['last_login']
);

echo "
    <div class='modal-header d-flex justify-content-between'>
        <h5 class='modal-title' id='exampleModalLabel'>내 정보</h5>
        <a href='/manage_member/member_delete.php' class='btn btn-outline-danger'>탈퇴</a>
    </div>
    <div class='modal-body'>
        <form id='info' action='/manage_member/process_member_update.php' method='post'>
            <input type='hidden' name='return_page' value='". $redirect ."'>
            <div class='mb-3'>
                <label for='input_user_id' class='form-label'>아이디</label>
                <input type='text' class='form-control' name='user_id' id='input_user_id' value='{$info['user_id']}' placeholder='{$info['user_id']}' disabled>
            </div>
            <div class='mb-3'>
                <label for='input_user_name' class='form-label'>이름</label>
                <input type='text' class='form-control' name='user_name' id='input_user_name' value='{$info['user_name']}' placeholder='{$info['user_name']}'>
            </div>
        </form>
    </div>
    <div class='modal-footer d-flex justify-content-between'>
        <div class='last-login'>
                <span style='font-weight: bold;'>Last Login |</span>
                <span>{$info['last_login']}</span>
            </div>
        <div>
            <button form='info' type='submit' class='btn btn-primary' data-bs-dismiss='modal'>저장</button>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>닫기</button>
        </div>
    </div>
";