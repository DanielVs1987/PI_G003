<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <header>
        <img src="../imag/bola.png" alt="logo" class="logoheader"></a>

        <nav>
            <ul class="menuPrincipal">
                <li class="botaoMenu">
                    <a href="../index.html">Home</a>
                </li>
                <li class="botaoMenu">
                    <a href="../paginas/pgemconstrucao.html">Pagina2</a>
                </li>
                <li class="botaoMenu">
                    <a href="../paginas/pgemconstrucao.html">Pagina3</a>
                </li>
                <li class="botaoMenu">
                    <p>Faça seu <a href="index.php">LOGIN</a></p>
                </li>

            </ul>
        </nav>

    </header>
    <div class="login">
        <form method="post" action="cadastro.php">
            <h1 class="titulo">Faça seu Cadastro</h1>
            <div class="inputConteiner">
                <input placeholder="Digite seu Nome" type="text" name="Nome" required>
                <img src="../imag/icons8-nome-48.png" alt="usuario" class="imgLogin">
            </div>
            <div class="inputConteiner">
                <input placeholder="Digite seu E-mail" type="email" name="Email" required>
                <img src="../imag/icons8-nova-mensagem-48.png" alt="usuario" class="imgLogin">
            </div>
            <div class="inputConteiner">
                <input placeholder="Digite seu telefone" type="tel" name="Telefone" required>
                <img src="../imag/icons8-telefone-desligado-48.png" alt="usuario" class="imgLogin">
            </div>
            <div class="inputConteiner">
                <input placeholder="Digite seu Idade" type="date" name="Nascimento" required>
                <img src="../imag/icons8-calendário-de-ano-novo-48.png" alt="usuario" class="imgLogin">
            </div>
            <div class="inputConteiner">
                <input placeholder="Digite sua Senha" type="password" name="Senha" required>
                <img src="../imag/icons8-senha-48.png" alt="senha"><br>
            </div>

            <button type="submit" class="botaoEnviar">Enviar</button>

        </form>
                
    </div>
    <footer>
        <div class="linksFooter">

            <ul class="redesSociais">
                <li><a target="_blank" href="#"><img src="../imag/icons8-facebook-novo-50.png" alt="facebook"
                            class="iconRedes"></a></li>
                <li><a target="_blank" href="#"><img src="../imag/icons8-tiktok-50.png" alt="tiktok"
                            class="iconRedes"></a></li>
                <li><a target="_blank" href="#"><img src="../imag/icons8-instagram-50.png" alt="instagram"
                            class="iconRedes"></a></li>
                <li><a target="_blank" href="#"><img src="../imag/icons8-twitter-50.png" alt="x" class="iconRedes"></a>
                </li>
            </ul>

            <ul class="termos">
                <li><a class="termosTexto" href="../paginas/termosDeUso.html">Termos de Uso</a></li>
                <li><a class="termosTexto" href="../paginas/politicaDePrivacidade.html">Política de Privacidade</a></li>
            </ul>
        </div>
        <div class="contfooter">
            <p>&copy;</p>
            <p class="texto"> 2024 Grupo 003 PI Todos os direitos reservados.</p>

        </div>
    </footer>

</body>

</html>