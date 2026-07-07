<?php

    session_start();

    require_once '../src/models/model_usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['page']) && $_GET['page'] === 'login'){
        $raw = file_get_contents('php://input');
        $dados = json_decode($raw, true);

        if (!$dados){
            $dados = $_POST;
        }

        if (!$dados || (!isset($dados['usuario']) || !isset($dados['senha']))){
            echo json_encode(['sucesso' => false, 'erro' => 'Envie usuario e senha']);
            exit;
        }

        $usuario = trim($dados['usuario']);
        $senha = $dados['senha'];

        $user = Usuario::login($usuario, $senha);

        if ($user){
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            echo json_encode(['sucesso' => true, 'nome' => $user['nome']]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'nome de usuário ou senha incorreta']);
        }
        exit;
    }

    if (isset($_GET['page']) && $_GET['page'] === 'logout'){
        session_destroy();
        header('Location: index.php');
        exit;
    }

    $page = $_GET['page'] ?? 'home';

switch ($page){
    case 'home':
        require_once '../src/controllers/controller_r.php';
        $controller = new controladoraFeed();
        $dadosFeed = $controller->exibirFeed();
        $totalReceitas = $dadosFeed['totalReceitas'];
        $totalPaginas = $dadosFeed['totalPaginas'];
        $receitas = $dadosFeed['receitas'];
        $paginaAtual = $dadosFeed['paginaAtual'];
        include '../src/views/home.php';
    case 'login':
        include '../src/views/login.php';
    break;
}
