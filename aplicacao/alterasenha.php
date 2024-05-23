<?php



require_once "config.php";

//busca o email do usuario logado

$Email = $_SESSION["email"];

//localiza o idUsuario

$sql = "SELECT idUsuarios FROM usuarios WHERE Email = '$Email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_usuario_logado = $row["idUsuarios"];
    }
} else {
    echo "0 results";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $senha_antiga = $_POST['senha_antiga'];
    $senha_nova = $_POST['senha_nova'];
    $senha_nova_confirmacao = $_POST['senha_nova_confirmacao'];


    $sql = "SELECT Senha FROM usuarios WHERE idUsuarios ='$id_usuario_logado'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $senha_hash = $row['Senha'];
    if (password_verify($senha_antiga, $senha_hash)) {

        if ($senha_nova == $senha_nova_confirmacao) {

            $senha_nova_hash = password_hash($senha_nova, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET Senha='$senha_nova_hash' WHERE idUsuarios ='$id_usuario_logado'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                    document.getElementById('mensagemErro').textContent = 'Senha Alterada com Sucesso!';});</script>";
                header("Refresh:3; url=alterasenha.php");
            } else {
                echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                    document.getElementById('mensagemErro').textContent = 'Erro na Atualização da Senha!';});</script>" . $conn->error;
                header("Refresh:3; url=alterasenha.php");
            }
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                document.getElementById('mensagemErro').textContent = 'Senha Incorreta!.';});</script>";
        }
    } else {
        echo "Senha antiga incorreta";
    }

}

$conn->close();
?>


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
                    <p>Atere sua <a href="alterasenha.php">Senha</a></p>
                </li>
                <li class="botaoMenu">
                    <p>Voltar para <a href="site.php">Reservas</a></p>
                </li>

            </ul>
        </nav>

    </header>
    <div class="login">
        <form method="post" action="alterasenha.php">
            <h1 class="titulo">Altere Sua Senha</h1>
            <div class="saldacao">
            </div>


            <div class="inputConteiner">
                <label for="senha_antiga" class="formLabel">
                    <input class="formInput" type="password" id="senha_antiga" name="senha_antiga"
                        placeholder="Sua Senha Antiga" maxlength="20" required>
                    <img src="../imag/icons8-senha-48.png" alt="senha"><br>
                </label>
            </div>

            <div class="inputConteiner">
                <label for="senha_nova" class="formLabel">
                    <input class="formInput" type="password" id="senha_nova" name="senha_nova"
                        placeholder="Sua Nova Senha" maxlength="20" required>
                    <img src="../imag/icons8-senha-48.png" alt="senha"><br>
                </label>
            </div>

            <div class="inputConteiner">
                <label for="senha_nova_confirmacao" class="formLabel">
                    <input class="formInput" type="password" id="senha_nova_confirmacao" name="senha_nova_confirmacao"
                        placeholder="Confirmar Senha" maxlength="20" required>
                    <img src="../imag/icons8-senha-48.png" alt="senha"><br>
                </label>
            </div>

            <button type="submit" value="Alterar Senha" class="botaoEnviar">Enviar</button>
            <div class="mensagem">
                <p class="mensagem" id="mensagemErro"></p>
            </div>

            <div class="mensagem">
                <p id="mensagemErro"></p>
            </div>

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