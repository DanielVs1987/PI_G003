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

//busca os dados

$sql = "SELECT Nome, Email, Telefone, Nascimento FROM usuarios WHERE idUsuarios = $id_usuario_logado";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Nome = $row["Nome"];
        $Email = $row["Email"];
        $Telefone = $row["Telefone"];
        $Nascimento = $row["Nascimento"];
    }
} else {
    echo "0 results";
}

//envio de alteraçao e mensagens de erro ou sucesso no envio 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmailNovo = $_POST["EmailNovo"];
    $TelefoneNovo = $_POST["TelefoneNovo"];
    $NascimentoNovo = $_POST["NascimentoNovo"];

    if (!is_null($id_usuario_logado) && $id_usuario_logado != '') {
        $sql = "UPDATE usuarios SET Email = ?, Telefone = ?, Nascimento = ? WHERE idUsuarios = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $EmailNovo, $TelefoneNovo, $NascimentoNovo, $id_usuario_logado);

        if ($stmt->execute()) {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                document.getElementById('mensagemErro').textContent = 'Cadastro Atualizado Com Sucesso!';});</script>";
            header("Refresh:3; url=alteracadastro.php");
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                document.getElementById('mensagemErro').textContent = 'Insira os dados antes de enviar!';});</script>";
            header("Refresh:3; url=alteracadastro.php");
        }
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { 
            document.getElementById('mensagemErro').textContent = 'Insira os dados antes de enviar!.';});</script>";
    }


}

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
        <form method="post" action="alteracadastro.php">
            <h1 class="titulo">Altere Seu Cadastro</h1>
            <div class="saldacao">
            </div>
            <p class="mensagem">Email atual: <?php echo $Email ?></p> 
            <div class="inputConteiner">
                <input placeholder="" type="email" name="EmailNovo">
                <img src="../imag/icons8-nova-mensagem-48.png" alt="usuario" class="imgLogin">
            </div>
            <p class="mensagem">Telefone atual: <?php echo $Telefone ?></p>
            <div class="inputConteiner">

                <input placeholder="" type="tel" name="TelefoneNovo">
                <img src="../imag/icons8-telefone-desligado-48.png" alt="usuario" class="imgLogin">
            </div>
            <p class="mensagem">Nascimento atual: <?php echo $Nascimento ?></p>
            <div class="inputConteiner">

                <input placeholder="" type="date" name="NascimentoNovo">
                <img src="../imag/icons8-calendário-de-ano-novo-48.png" alt="usuario" class="imgLogin">
            </div>

            <button type="submit" class="botaoEnviar">Enviar</button>
            <div class="mensagem">
                <p class="mensagem" id="mensagemErro"></p>
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