<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/delete_parameter.php';

class Pagination {

    //클래스 내부에서 하단 페이지넘버 처리에 필요한 변수
    private
        $page,
        $total_page,
        $first_page,
        $last_page,
        $prev_page,
        $next_page,
        $total_block,
        $next_block,
        $next_block_page,
        $prev_block,
        $prev_block_page,
        $page_nav = "",
        $PHP_SELF = "/index.php";
    //설정에서 register_globals=Off 인 경우에 $PHP_SELF 수퍼변수는 동작하지 않기때문에 경로를 지정해주는것이 좋다.

    //클래스 외부에서 필요한 변수
    public
        $limit_idx,
        $page_set;

    //페이지 줄수, 블럭수 받아 데이터 정리
    public function __construct($page_count, $block_count, $page_num, $is_my_board) {
        $block_set      = $block_count; // 한페이지 블럭수
        $this->page_set = $page_count;  // 한페이지 줄수

        $result = DB::query("SELECT count(board_id) AS total FROM board {$is_my_board}")[0];
        $total = $result['total']; // 전체글수

        $this->total_page  = ceil($total / $this->page_set);        // 총페이지수(올림함수)
        $this->total_block = ceil($this->total_page / $block_set);  // 총블럭수(올림함수)

        $this->page = $page_num;                         // parameter로 현재 페이지정보를 받아옴
        $block = ceil($this->page / $block_set);    // 현재블럭(올림함수)
        $this->limit_idx = ($this->page - 1) * $this->page_set; // limit 시작위치

        $this->first_page = (($block - 1) * $block_set) + 1;    // 첫번째 페이지번호
        $this->last_page  = min($this->total_page, $block * $block_set); // 마지막 페이지번호

        $this->prev_page = $this->page - 1; // 이전페이지
        $this->next_page = $this->page + 1; // 다음페이지

        $this->prev_block = $block - 1; // 이전블럭
        $this->next_block = $block + 1; // 다음블럭

        // 이전블럭을 블럭의 마지막으로 하려면...
        $this->prev_block_page = $this->prev_block * $block_set; // 이전블럭 페이지번호

        // 이전블럭을 블럭의 첫페이지로 하려면...
        //$prev_block_page = $prev_block * $block_set - ($block_set - 1);

        $this->next_block_page = $this->next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호
    }

    //하단 페이지 넘버링
    public function BottomPageNumber(): string {
        $this->page_nav .= ($this->prev_page > 0) ?
            "<li class='page-item'><a class='page-link' href='$this->PHP_SELF?page=$this->prev_page'>Prev</a></li>" :
            "<li class='page-item disabled'><span class='page-link'>Prev</span></li>";

        $this->page_nav .= ($this->prev_block > 0) ?
            "<li class='page-item'><a class='page-link' href='$this->PHP_SELF?page=$this->prev_block_page'>...</a></li>" :
            "<li class='page-item disabled'><span class='page-link'>...</span></li>";

        for ($i = $this->first_page; $i <= $this->last_page; $i++) {
            $this->page_nav .= ($i != $this->page) ?
                "<li class='page-item'><a class='page-link' href='$this->PHP_SELF?page=$i'>$i</a></li>" :
                "<li class='page-item disabled'><span class='page-link'>$i</span></li>";
        }

        $this->page_nav .= ($this->next_block <= $this->total_block) ?
            "<li class='page-item'><a class='page-link' href='$this->PHP_SELF?page=$this->next_block_page'>...</a></li>" :
            "<li class='page-item disabled'><span class='page-link'>...</span></li>";

        $this->page_nav .= ($this->next_page <= $this->total_page) ?
            "<li class='page-item'><a class='page-link' href='$this->PHP_SELF?page=$this->next_page'>Next</a></li>" :
            "<li class='page-item disabled'><span class='page-link'>Next</span></li>";

        // 페이지 파라미터 중복 제거
        $this->PHP_SELF = delete_parameter($this->PHP_SELF, 'page');

        return $this->page_nav;
    }
}