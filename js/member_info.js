document.getElementById('info_btn').addEventListener('click', () => {
    // fetch (String.raw('D:/projects/PhpstormProjects/CRUDboardsite/manage_member/modal_member_info.php'), {
    //     method: 'GET',
    //     cache: 'no-cache'
    // })
    //     .then((res) => res.text())
    //     .then((modal_data) => {
    //         const modal_content = document.getElementsByClassName('modal-content')[0];
    //         modal_content.innerHTML = modal_data;
    //         console.log(modal_data);
    //     });

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'D:/projects/PhpstormProjects/CRUDboardsite/manage_member/modal_member_info.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState !== 4) return;    // 작업이 완료되지 않으면 return

        if (xhr.status === 200) {
            const modal_content = document.getElementsByClassName('modal-content')[0];
            modal_content.innerHTML = xhr.responseText;
        } else {
            console.log('HTTP ERROR', xhr.status, xhr.statusText);
        }
    }
    // start request
    xhr.send();
});