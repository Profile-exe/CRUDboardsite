// 로그인 유무에 따라 dropdown 버튼 활성화 결정
const loginout_btn = document.getElementById('loginout_btn');
switch (loginout_btn.innerText) {
    case '로그인': {
        document.getElementById('dropdown-toggle').classList.add('disabled');
        break;
    }
    case '로그아웃': {
        document.getElementById('dropdown-toggle').classList.remove('disabled');
        break;
    }
}