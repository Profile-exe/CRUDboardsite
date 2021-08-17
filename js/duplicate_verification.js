'use strict';

// Click event about 'duplicate verification button'
document.getElementById('duplicate_check_btn').addEventListener('click', () => {
    // input창 아이디 string 가져오기
    const input_id = document.getElementById('id').value;

    // 빈 문자열이면 바로 반환
    if (input_id === '') {
        change_btn_status(false, '아이디를 입력하세요.');
        return;
    }

    // request body에 json 형태로 id를 담아서 요청
    fetch('../manage_member/process_duplicate_verification.php', {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
        body: JSON.stringify({
            id: input_id
        })
    })
        .then((res) => res.text())
        .then((data) => {
            switch(data) {
                case 'true': {      // 사용 가능한 아이디
                    change_btn_status(true);
                    break;
                }
                case 'false': {     // 사용 불가능한 아이디
                    change_btn_status(false);
                    break;
                }
            }
        });
});

function change_btn_status(bool, msg = '') {
    const id_form = document.getElementById('id');
    const feedback_list = document.getElementById('input_id').children;
    if (bool) { // true : 사용 가능한 아이디
        make_valid(id_form, feedback_list);
    } else {    // false : 중복된 아이디
        make_invalid(id_form, feedback_list, msg);
    }
}

// 중복 확인 검사를 거치지 않은 경우 이벤트 취소
document.getElementById('register_form').addEventListener('submit', (e) => {
    const id_form = document.getElementById('id');
    if (!id_form.classList.contains('is-valid')) {
        alert('아이디 중복을 확인하세요');
        e.preventDefault();
    }
});

document.getElementById('id').addEventListener('change', (e) => {
    const feedback_list = e.target.parentNode.parentNode.children;
    make_default(e.target, feedback_list);
});


