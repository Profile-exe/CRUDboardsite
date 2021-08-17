function make_default(element, feedback_list) {
    element.classList.remove('is-valid');
    element.classList.remove('is-invalid');

    for (const item of feedback_list) {
        if (item.classList.contains('valid-feedback'))
            item.style.display = 'none';
        if (item.classList.contains('invalid-feedback'))
            item.style.display = 'none';
    }
}

function make_valid(element, feedback_list) {
    element.classList.add('is-valid');
    element.classList.remove('is-invalid');

    for (const item of feedback_list) {
        if (item.classList.contains('valid-feedback'))
            item.style.display = 'block';
        if (item.classList.contains('invalid-feedback'))
            item.style.display = 'none';
    }
}

function make_invalid(element, feedback_list, msg) {
    element.classList.add('is-invalid');
    element.classList.remove('is-valid');

    for (const item of feedback_list) {
        if (item.classList.contains('valid-feedback'))
            item.style.display = 'none';
        if (item.classList.contains('invalid-feedback')) {
            if (msg === '') {
                item.classList.add('duplicate');
                item.classList.remove('empty');
            }
            else {
                item.classList.add('empty');
                item.classList.remove('duplicate');
            }
            item.style.display = 'block';
        }
    }
}