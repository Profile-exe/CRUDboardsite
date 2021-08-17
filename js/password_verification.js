'use strict';

// Click event about 'passwd check button'
document.getElementById('passwd_check_btn').addEventListener('click', () => {
    // input창 아이디 string 가져오기
    const password = document.getElementById('passwd').value;

    // 빈 문자열이면 바로 반환
    if (password === '') {
        change_btn_status(false, '비밀번호를 입력하세요.');
        return;
    }

    // request body에 json 형태로 id를 담아서 요청
    fetch('../manage_member/process_password_check.php', {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
        body: JSON.stringify({
            password: password
        })
    })
        .then((res) => res.text())
        .then((data) => {
            switch(data) {
                case 'true': {      // 비밀번호 일치
                    change_btn_status(true);
                    break;
                }
                case 'false': {     // 비밀번호 불일치
                    change_btn_status(false);
                    break;
                }
            }
        });
});

function change_btn_status(bool, msg = '') {
    const passwd_form = document.getElementById('passwd');
    const feedback_list = document.getElementById('passwd_verification').children;
    if (bool) { // true : 사용 가능한 아이디
        make_valid(passwd_form, feedback_list);
    } else {    // false : 중복된 아이디
        make_invalid(passwd_form, feedback_list, msg);
    }
}

// 중복 확인 검사를 거치지 않은 경우 이벤트 취소
document.getElementById('withdrawal_form').addEventListener('submit', (e) => {
    const passwd_form = document.getElementById('passwd');
    if (!passwd_form.classList.contains('is-valid')) {
        alert('올바른 비밀번호인지 확인하세요');
        e.preventDefault();
    }
});

document.getElementById('passwd').addEventListener('change', (e) => {
    const feedback_list = e.target.parentNode.parentNode.children;
    make_default(e.target, feedback_list);
});