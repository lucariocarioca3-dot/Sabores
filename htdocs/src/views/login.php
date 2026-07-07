<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
    <title>Sabores - Login</title>
</head>

<body>
    <img src="img/logo_sabores/Sabores.png" alt="Sabores" class="logo2" />
    <div class="modal-overlay" id="modalLogin">
        <div class="modal">
            <button class="modal-fechar" id="fecharModal">&times;</button>
        
            <h2>Sabores</h2>
            <form id="formLogin">
                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="seu@email.com" required />
                <label for="senha">Senha</label>
                <input type="password" id="senha" placeholder="Sua senha" required />
                <span id="erroLogin" class="erro-login"></span>
                <button id="button_logar" type="submit">Login</button>
                <button type="submit" id="button_cancelar">Cancelar</button>
            </form>

            <footer>
                <div class="footer_modal">
                    <img src="img/icones/instagram.svg" alt="Instagram" />
                    <img src="img/icones/twitter.svg" alt="Twitter" />
                    <img src="img/icones/tikTok.svg" alt="TikTok" />
                </div class="footer_modal">
            </footer>
        </div>
    </div>
</body>