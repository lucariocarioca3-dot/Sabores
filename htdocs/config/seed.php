<?php
require_once 'database.php';

$pdo = getConnection();

// === Usuários ===
$pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $pdo->prepare("REPLACE INTO usuarios (email, senha, nome) VALUES (?, ?, ?)");
$stmt->execute(['admin@email.com', '123456', 'Admin']);
$stmt->execute(['teste@email.com', '123456', 'Teste']);

$stmt2 = $pdo->prepare("REPLACE INTO usuarios (email, senha, nome) VALUES (?, ?, ?)");
$stmt2->execute(['sabores@email.com', '123456', 'Sabores']);

echo "Usuários atualizados com sucesso!\n";

// === Receitas (usando a estrutura existente da tabela) ===
$pdo->exec("CREATE TABLE IF NOT EXISTS receitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_receita VARCHAR(255) NOT NULL,
    titulo_receita VARCHAR(255) NOT NULL,
    custo_total DECIMAL(10,2) NOT NULL,
    tempo_preparo_minutos INT NOT NULL,
    rendimento_porcoes INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)");

$stmt = $pdo->prepare("REPLACE INTO receitas (tipo_receita, titulo_receita, custo_total, tempo_preparo_minutos, rendimento_porcoes, usuario_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute(['Sobremesa',       'Bolo de Chocolate',    25.00, 40, 8,  1]);
$stmt->execute(['Entrada',         'Pão de Queijo',        15.00, 30, 6,  1]);
$stmt->execute(['Prato Principal', 'Lasanha',              35.00, 60, 10, 1]);
$stmt->execute(['Entrada',         'Salada Caesar',        20.00, 15, 4,  1]);
$stmt->execute(['Sobremesa',       'Torta de Limão',       28.00, 50, 8,  1]);
$stmt->execute(['Prato Principal', 'Strogonoff de Frango', 30.00, 35, 4,  1]);
$stmt->execute(['Prato Principal', 'Panqueca de Carne',    22.00, 45, 6,  1]);
$stmt->execute(['Entrada',         'Sopa de Legumes',      18.00, 25, 4,  1]);
$stmt->execute(['Prato Principal', 'Pizza Caseira',        32.00, 55, 8,  1]);

echo "Receitas inseridas com sucesso!\n";
