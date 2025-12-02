<?php
// Auth helpers
if (session_status() === PHP_SESSION_NONE) session_start();

function login_user(array $user) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'] ?? 'client';
}

function logout_user() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_role']);
}

function current_user() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['user_id'])) return null;
    require_once __DIR__ . '/../models/User.php';
    return User::findById(intval($_SESSION['user_id']));
}

function is_logged_in() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return !empty($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        set_flash('error', 'Você precisa estar logado para acessar essa página.');
        header('Location: index.php?r=auth/login');
        exit;
    }
}

function require_role(string $role) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== $role) {
        set_flash('error', 'Você não tem permissão para acessar essa página.');
        header('Location: index.php?r=auth/login');
        exit;
    }
}
