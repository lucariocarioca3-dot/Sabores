<?php
    function getConnection(){
        // Verifica se está rodando na Vercel
        if (isset($_SERVER['VERCEL']) || isset($_SERVER['VERCEL_ENV'])) {
            throw new PDOException("Banco de dados local não disponível na Vercel.");
        }

        $host = 'localhost';
        $dbname = 'receitas_db';
        $username = 'root';
        $password = '';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $exception) {
            throw $exception;
        }
    }
?>
