document.getElementById('info_btn').addEventListener('click', () => {
    fetch ('/manage_member/modal_member_info.php', {
        method: 'GET',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'include'
    })
        .then((res) => res.text())
        .then((modal_data) => {
            const modal_content = document.getElementsByClassName('modal-content')[0];
            modal_content.innerHTML = modal_data;
        });
});