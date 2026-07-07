<?php
    require_once __DIR__ . '/../../config/database.php';

    class recipe{
        public static function getTotal_nf(){
            try {
                $pdo = getConnection();
                $sql = "SELECT COUNT(*) FROM receitas";
                $stmt = $pdo->query($sql);
                return $stmt->fetchColumn();
            } catch (PDOException $e) {
                return 0;
            }
        }

        public static function getReceitas($limite, $offset){
            try {
                $pdo = getConnection();
                $sql = "SELECT * FROM receitas LIMIT ? OFFSET ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
                $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }
        }
    }
