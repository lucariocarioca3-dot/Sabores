<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
    <title>Sabores - Receitas</title>
</head>

<body>
    <aside class="perfil">
        <div>
            <img src="img/logo_sabores/Sabores.png" alt="Sabores" class="logo" />
            <h1>Sabores</h1>
            <p>Total de receitas: <?= $totalReceitas ?? 12 ?></p>
            <p>Total de porções: 58</p>
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <p class="usuario-logado">Bem-vindo, <?= $_SESSION['usuario_nome'] ?></p>
                <button>Adicionar Receita</button>
            <?php else: ?>
                <button disabled>Adicionar Receita</button>
            <?php endif; ?>
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <button class="btn-sair" onclick="location.href='index.php?page=logout'">Sair</button>
            <?php endif; ?>
        </div>
        <footer>
            <div>
                <img src="img/icones/instagram.svg" alt="Instagram" />
                <img src="img/icones/twitter.svg" alt="Twitter" />
                <img src="img/icones/tikTok.svg" alt="TikTok" />
            </div>
        </footer>
    </aside>

    <main>
        <header>
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <span class="usuario-topo">Olá, <?= $_SESSION['usuario_nome'] ?></span>
                <a href="index.php?page=logout" class="logout-link">Sair</a>
            <?php else: ?>
                <button class="login">Login</button>
            <?php endif; ?>
        </header>

        <section class="filtros">
            <button class="ativo">Entrada</button>
            <button>Prato Principal</button>
            <button>Sobremesa</button>
        </section>

        <section class="receitas">
            <?php if (!empty($receitas)): ?>
                <?php foreach ($receitas as $r): ?>
                <article class="receita">
                    <h2><?= htmlspecialchars($r['titulo_receita']) ?></h2>
                    <div class="usuario">
                        <img src="img/imagens_perfil/usuario02.jpg" alt="Usuário" class="foto-perfil" />
                        <span><?= htmlspecialchars($r['usuario_id'] ?? 'Sabores') ?></span>
                    </div>
                    <p>Custo: R$ <?= number_format($r['custo_total'], 2, ',', '.') ?></p>
                    <p>Tempo: <?= (int)$r['tempo_preparo_minutos'] ?> min</p>
                    <p>Porções: <?= (int)$r['rendimento_porcoes'] ?></p>
                    <p><?= date('H:i - d/m/y', strtotime($r['criado_em'])) ?></p>
                    <div class="interacoes">
                        <img src="img/icones/coracao.svg" alt="Curtir" />
                        <img src="img/icones/comentario.svg" alt="Comentar" />
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="sem-receitas">Nenhuma receita encontrada.</p>
            <?php endif; ?>
        </section>

        <?php if ($totalPaginas > 1): ?>
        <div class="paginacao">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?pag=<?= $i ?>" class="<?= $i === $paginaAtual ? 'ativo' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </main>

    <div class="modal-overlay" id="modalLogin">
        <div class="modal">
            <button class="modal-fechar" id="fecharModal">&times;</button>
            <div class="modal-logo">
                <img src="img/logo_sabores/Sabores.png" alt="Sabores" />
            </div>
            <h2>Sabores</h2>
            <form id="formLogin">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" placeholder="Seu usuário" required />
                <label for="senha">Senha</label>
                <input type="password" id="senha" placeholder="Sua senha" required />
                <span id="erroLogin" class="erro-login"></span>
                <button type="submit">Login</button>
                <button type="button" class="btn-cancelar" onclick="document.getElementById('modalLogin').classList.remove('aberto')">Cancelar</button>
            </form>
            <footer class="modal-footer">
                <img src="img/icones/instagram.svg" alt="Instagram" />
                <img src="img/icones/twitter.svg" alt="Twitter" />
                <img src="img/icones/tikTok.svg" alt="TikTok" />
            </footer>
        </div>
    </div>

</body>
</html>
