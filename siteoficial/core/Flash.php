<?php

if (session_status() === PHP_SESSION_NONE) session_start();

function set_flash(string $key, string $message) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['flash_messages'][$key] = $message;
}

function get_flash(string $key) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['flash_messages'][$key])) return null;
    $msg = $_SESSION['flash_messages'][$key];
    unset($_SESSION['flash_messages'][$key]);
    return $msg;
}

function has_flash(string $key) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return !empty($_SESSION['flash_messages'][$key]);
}