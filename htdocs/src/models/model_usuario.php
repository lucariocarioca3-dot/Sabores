<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario{
    public static function login($usuario, $senha){
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT id, email, senha, nome FROM usuarios WHERE (TRIM(email) = ? OR TRIM(nome) = ?) AND TRIM(senha) = ?");
        $stmt->execute([trim($usuario), trim($usuario), trim($senha)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
