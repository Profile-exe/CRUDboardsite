const url = new URL(window.location.href);
const urlParams = url.searchParams;

let page = urlParams.get('page');
if (page === null) page = '1';

const body = {          // AJAX request body
    id: '',
    page_count: 10,     // 한 페이지에 표시할 글의 수
    page_num: page,     // 현재 페이지
    is_my_board: false  // 필터링 on / off 유무
}

function my_board_checked() {       // 페이지 변경 시 필터링 스위치 checked 확인
    const board_switch = document.getElementById('my_boards_switch');
    if (get_cookie('my_board_filter') !== '') { // 쿠키 유무로 스위치 on/off 확인
        body.is_my_board = true;
        board_switch.click();       // 스위치 활성화 되어 있으면 click()로 재활성화
    } else {
        body.is_my_board = false;
    }
}

document.getElementById('my_boards_switch').addEventListener('click', (e) => {
    // 체크 된 경우 true
    if (e.target.checked) {
        body.id = e.target.value;
        body.is_my_board = true;
        set_cookie('my_board_filter', true, 1);     // 쿠키 생성
    } else {
        body.is_my_board = false;
        set_cookie('my_board_filter', false, 0);    // 쿠키 제거
    }
    get_board_list(body);   // 목록 불러오기
});

function get_board_list(body) { // AJAX 이용
    const init = {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
        body: JSON.stringify(body)  // JSON 형태로 POST request
    }

    fetch('/manage_board/process_board_list.php', init)
        .then((res) => res.json())    // JSON 형태로 응답받고 parsing 후 사용
        .then((data) => {
            document.getElementById('board_list').innerHTML = data['topic_list'];
            document.getElementById('page-list').innerHTML = data['page_nav'];
        });
}

my_board_checked();
get_board_list(body);