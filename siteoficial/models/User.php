<?php
include_once __DIR__ . '/../conexao.php';

class User {
    protected static $table = 'users';

    public static function findByEmail(string $email) {
        global $mysqli;
        $email = $mysqli->real_escape_string($email);
        $res = $mysqli->query("SELECT * FROM " . self::$table . " WHERE email = '{$email}' LIMIT 1") or die($mysqli->error);
        return $res->fetch_assoc();
    }

    public static function findById(int $id) {
        global $mysqli;
        $id = intval($id);
        $res = $mysqli->query("SELECT * FROM " . self::$table . " WHERE id = '{$id}' LIMIT 1") or die($mysqli->error);
        return $res->fetch_assoc();
    }

    public static function create(array $data) {
        global $mysqli;
        $email = $mysqli->real_escape_string($data['email'] ?? '');
        $passwordHash = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);
        $role = $mysqli->real_escape_string($data['role'] ?? 'client');
        $sql = "INSERT INTO " . self::$table . " (email, password, role, created_at) VALUES ('{$email}', '{$passwordHash}', '{$role}', NOW())";
        return $mysqli->query($sql) ? $mysqli->insert_id : false;
    }

    public static function verifyPassword(string $email, string $password) {
        $user = self::findByEmail($email);
        if (!$user) return false;
        if (password_verify($password, $user['password'])) return $user;
        return false;
    }
}