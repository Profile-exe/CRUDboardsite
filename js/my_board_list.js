function board_filter(e, user_name) {
    const board_list = document.getElementById('board_list').children;
    if (e.checked) {
        for (const board of board_list) {
            const author = board.children.item(2).textContent;
            if (author !== user_name) {
                board.style.display = 'none';
            }
        }
    } else {
        for (const board of board_list)
            board.style.display = 'table-row';
    }
}