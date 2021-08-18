<?php
function delete_parameter($url, $key) {
    if (!str_contains($url, '?')) {
        return $url;
    }

    list($url, $query) = explode('?', $url);
//    $temp = explode('?', $query);
//
//    foreach ($temp as $key => $value) {
//        if (substr($value, 0, strlen($key) + 1) == $key.'=') {
//            unset($temp[$key]);
//        }
//    }
//
//    return $url.'?'.implode('&', $temp);
    return $url;
}