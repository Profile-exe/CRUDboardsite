const url = new URL(window.location.href);
const urlParams = url.searchParams;

let page = urlParams.get('page');
if (page === null) page = '1';

const body = {
    id: '',
    page_num: page,
    is_my_board: false
}

function my_board_checked() {
    const board_switch = document.getElementById('my_boards_switch');
    if (get_cookie('my_board_filter') !== '') {
        body.is_my_board = true;
        board_switch.click();
    } else {
        body.is_my_board = false;
    }
}

document.getElementById('my_boards_switch').addEventListener('click', (e) => {
    // 체크 된 경우 true
    if (e.target.checked) {
        body.id = e.target.value;
        body.is_my_board = true;
        set_cookie('my_board_filter', true, 1);
    } else {
        body.is_my_board = false;
        set_cookie('my_board_filter', false, 0);
    }
    get_board_list(body);
});

function get_board_list(body) {
    const init = {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
        body: JSON.stringify(body)
    }

    fetch('/manage_board/process_board_list.php', init)
        .then((res) => res.text())
        .then((data) => {
            console.log(data);
            const response_obj = JSON.parse(data);
            document.getElementById('board_list').innerHTML = response_obj[0];
            document.getElementById('page-list').innerHTML = response_obj[1];
        });
}

my_board_checked();
get_board_list(body);