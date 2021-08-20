<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';

$post_data = json_decode(file_get_contents('php://input'));

if ($post_data->id == '') die('false'); // 빈 입력은 false 반환

$result = null;
try {
    $result = DB::query('SELECT * FROM user WHERE user_id=:id', array(':id' => $post_data->id));
} catch (Exception $e) {
    // 쿼리에서 에러 발생 시 false로 처리
    die('false');
}

if (count($result) > 0) {
    echo 'false';
} else {
    echo 'true';
}
