<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/pagination.class.php';

// 세션 시작 - $_SESISON['user_id'] 사용을 위해.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$post_data = json_decode(file_get_contents('php://input')); // JSON 형태로 받은 데이터 객체로 parsing

// 필터링 유무에 따라 WHERE 구문 삽입 유무로 쿼리문 결정
// WHERE이 삽입되면 자신이 작성한 글만 fetch
$my_board = $post_data->is_my_board ? "WHERE board.user_id = '{$_SESSION['user_id']}'\n" : '';

$sql = "
    SELECT
        board_id, board_title, user_name, date_format(created, '%m-%d %H:%i') as created, view_count 
    FROM board INNER JOIN user
    ON board.user_id = user.user_id
";

$sql .= $my_board;  // 만약 필터링 off인 경우 $my_board == '' 이므로 아무런 영향이 없다.

// 게시글 줄 수, 블럭 수
$pagination = new Pagination($post_data->page_count, 5, $post_data->page_num, $my_board);

// 페이지네이션을 위한 LIMIT
$sql .= trim("    
    ORDER BY created DESC LIMIT {$pagination->limit_idx}, {$pagination->page_set}
");

$result = DB::query($sql);

$topic_list = '';
if ($result) {  // 글이 존재하는 경우 table-row로 생성
    foreach ($result as $index => $row) {
        $topic_list .= "
            <tr style='cursor:pointer' onclick='location.href=\"/manage_board/board_read.php?id={$row['board_id']}\"'>
                <th class='col-1 text-center' scope='row'>{$row['board_id']}</th>
                <td class='col-7'>{$row['board_title']}</td>
                <td class='col-1 text-center'>{$row['user_name']}</td>
                <td class='col-2 text-center'>{$row['created']}</td>
                <td class='col-1 text-center'>{$row['view_count']}</td>
            </tr>
        ";
    }
}
// table-row랑 pagenation의 nav를 반환할 것임
$response = array(
    'topic_list' => $topic_list,
    'page_nav'   => $pagination->BottomPageNumber());

echo json_encode($response);    // JSON으로 encoding 후 반환