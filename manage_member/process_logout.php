<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
}

header('Location: '.$_SERVER['HTTP_REFERER']);
