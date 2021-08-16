document.getElementById('info_btn').addEventListener('click', () => {
    fetch ('manage_member/member_info.php', {
        method: 'GET',
        cache: 'no-cache'
    })
        .then((res) => res.text())
        .then((modal_data) => {
            const modal_content = document.getElementsByClassName('modal-content')[0];
            modal_content.innerHTML = modal_data;
            console.log(modal_data);
        });
});