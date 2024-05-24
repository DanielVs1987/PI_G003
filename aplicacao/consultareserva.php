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

//seciona os dados das reservas

$sql = "SELECT idReservas, idAgendamento, idHoras, idQuadras FROM reservas WHERE idUsuarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario_logado);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $c_reserva = $row["idReservas"];
        $c_agendamento = $row["idAgendamento"];
        $c_horas = $row["idHoras"];
        $c_quadras = $row["idQuadras"];
    }
} else {
    echo "<script>alert('Você não tem reservas!'); window.location.href='site.php';</script>";
    header("Refresh:1; url=site.php");
}


$sql = "SELECT Dias FROM dias WHERE idAgendamento = $c_agendamento";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diaSemana = $row["Dias"];

    }
} else {
    echo "0 results";
}

$sql = "SELECT Horas FROM horas WHERE idHoras = $c_horas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Hora = $row["Horas"];

    }
} else {
    echo "0 results";
}

$sql = "SELECT Nome FROM quadras WHERE idQuadras = $c_quadras";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $NomeQuadra = $row["Nome"];

    }
} else {
    echo "0 results";
}

$sql = "SELECT Nome FROM usuarios WHERE idUsuarios = $id_usuario_logado";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Nome = $row["Nome"];

    }
} else {
    echo "0 results";
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
    <h1 class="mensagem" id="mensagemErro"></h1>
    
    <div class="consultaReserva">


        <h1 class="titulo">Ola <?php echo $Nome ?> <br>Essas Sao Suas Reservas</h1>

        <div class="saldacao">
        </div>


        <div class="inputConteiner">
            <p class="mensagem">Quadra Reservada:<br> <?php echo $NomeQuadra ?></p>
        </div>


        <div class="inputConteiner">

            <p class="mensagem">Dia da Semana:<br> <?php echo $diaSemana ?></p>
        </div>


        <div class="inputConteiner">
            <p class="mensagem">Horario Reservado:<br> <?php echo $Hora ?></p>
        </div>

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