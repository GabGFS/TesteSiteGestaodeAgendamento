<?php
// Model Cliente - operações básicas
include_once __DIR__ . '/../conexao.php';

class Cliente {
    protected static $table = 'clientesnovos';

    public static function all() {
        global $mysqli;
        $res = $mysqli->query("SELECT * FROM " . self::$table . " ORDER BY id DESC") or die($mysqli->error);
        $rows = [];
        while($r = $res->fetch_assoc()) $rows[] = $r;
        return $rows;
    }

    public static function find(int $id) {
        global $mysqli;
        $id = intval($id);
        $res = $mysqli->query("SELECT * FROM " . self::$table . " WHERE id = '$id'") or die($mysqli->error);
        return $res->fetch_assoc();
    }

    public static function create(array $data) {
        global $mysqli;
        $nome = $mysqli->real_escape_string($data['nome'] ?? '');
        $email = $mysqli->real_escape_string($data['email'] ?? '');
        $celular = $mysqli->real_escape_string($data['celular'] ?? '');
        $sql = "INSERT INTO " . self::$table . " (nome, email, celular, data_de_cadastro) VALUES ('{$nome}','{$email}','{$celular}', NOW())";
        return $mysqli->query($sql) ? $mysqli->insert_id : false;
    }

    public static function update(int $id, array $data) {
        global $mysqli;
        $id = intval($id);
        $nome = $mysqli->real_escape_string($data['nome'] ?? '');
        $email = $mysqli->real_escape_string($data['email'] ?? '');
        $celular = $mysqli->real_escape_string($data['celular'] ?? '');
        $sql = "UPDATE " . self::$table . " SET nome='{$nome}', email='{$email}', celular='{$celular}' WHERE id = '$id'";
        return $mysqli->query($sql);
    }

    public static function delete(int $id) {
        global $mysqli;
        $id = intval($id);
        $sql = "DELETE FROM " . self::$table . " WHERE id = '$id'";
        return $mysqli->query($sql);
    }
}
