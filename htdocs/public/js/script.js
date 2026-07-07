document.addEventListener('DOMContentLoaded', function(){
    var loginBtn = document.querySelector('.login');
    var modal = document.getElementById('modalLogin');
    var fechar = document.getElementById('fecharModal');
    var form = document.getElementById('formLogin');
    var erro = document.getElementById('erroLogin');

    loginBtn.addEventListener('click', function(){
        modal.classList.add('aberto');
        if (erro) erro.textContent = '';
    });

    fechar.addEventListener('click', function(){
        modal.classList.remove('aberto');
    });

    modal.addEventListener('click', function(e){
        if (e.target === modal){
            modal.classList.remove('aberto');
        }
    });

    form.addEventListener('submit', function(e){
        e.preventDefault();
        if (erro) erro.textContent = '';

        var dados = {
            usuario: document.getElementById('usuario').value,
            senha: document.getElementById('senha').value
        };

        fetch('index.php?page=login', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(dados)
        })
        .then(function(res){
            if (!res.ok){
                throw new Error('Erro HTTP ' + res.status);
            }
            return res.json();
        })
        .then(function(data){
            if (data.sucesso){
                modal.classList.remove('aberto');
                loginBtn.textContent = 'Olá, ' + data.nome;
                loginBtn.disabled = true;
                location.reload();
            } else {
                if (erro){
                    erro.textContent = data.erro;
                } else {
                    alert(data.erro);
                }
            }
        })
        .catch(function(err){
            if (erro){
                erro.textContent = 'Erro de conexão: ' + err.message;
            } else {
                alert('Erro ao conectar: ' + err.message);
            }
        });
    });
});
