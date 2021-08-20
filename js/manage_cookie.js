function set_cookie(name, value, days) {
    const day = new Date();
    day.setTime(day.getTime() + days * 60 * 60 * 24 * 1000);
    const expires = 'expires=' + day.toUTCString();
    document.cookie = name + '=' + value + ';' + expires + ';path=/';
}

function get_cookie(cookie_name) {
    const name = cookie_name + '=';
    const decoded_cookie = decodeURIComponent(document.cookie);
    const cookie_list = decoded_cookie.split(';');

    for (let cookie of cookie_list) {
        if (cookie.trim().includes(name)) {
            return cookie.trim();
        }
    }

    return '';
}