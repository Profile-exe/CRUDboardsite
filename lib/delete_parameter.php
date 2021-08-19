<?php
function delete_parameter($url, $deleted) {
    if (!str_contains($url, '?')) {
        return $url;
    }

    // query string 분리
    list($url, $query) = explode('?', $url);
    // query string의 parameter 분리
    $temp = explode('&', $query);

    foreach ($temp as $key => $value) {
        // parameter가 "$deleted="인 경우 unset();
        if (substr($value, 0, strlen($deleted) + 1) == $deleted.'=') {
            unset($temp[$key]);
        }
    }

    if ($temp) {    // 다른 파라미터가 존재한다면 붙여서 반환
        return $url.'?'.implode('&', $temp);
    } else {        // 다른 파라미터가 없다면 url만 반환
        return $url;
    }
}