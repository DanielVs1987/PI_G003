<?php

//chama arquivos necessarios 

require_once "config.php";

//opera o logaut

function logout()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

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

//"exporta" o idUsuarios


//localiza nome do ususrio

$sql = "SELECT Nome FROM usuarios WHERE idUsuarios = '$id_usuario_logado'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Nome = $row["Nome"];
    }
} else {
    echo "0 results";
}

//seleciona status (reservado ou livre)

$sql = "SELECT reserva FROM reservas WHERE idReservas IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35)";
$result = $conn->query($sql);

$i = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ${"reserva" . $i} = $row["reserva"];
        $i++;
    }
} else {
    echo "0 results";

}

//seleciona horarios

$sql = "SELECT horas FROM horas WHERE idhoras IN (1, 2, 3, 4, 5)";
$result = $conn->query($sql);

$i = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ${"horas" . $i} = $row["horas"];
        $i++;
    }
} else {
    echo "0 results";
}

//mensagens de erro ou sucesso no envio

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_registro = $_POST["id_registro"];

    if (!is_null($id_registro) && $id_registro != '') {
        $sql = "UPDATE reservas SET reserva = 'Reservado', idUsuarios = $id_usuario_logado  WHERE idReservas = $id_registro";

        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                document.getElementById('mensagemErro').textContent = 'Reserva criada com Sucesso!';});</script>";
            header("Refresh:3; url=site.php");
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { 
                document.getElementById('mensagemErro').textContent = 'Você ainda nao escolheu uma Data e Hora!';});</script>";
            header("Refresh:3; url=site.php");
        }
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { 
            document.getElementById('mensagemErro').textContent = 'Escolha uma Data e Hora para reserva!.';});</script>";
    }

}

?>

<!--inicia o formulario html-->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/horarios.css">
    <title>Web Site</title>
</head>

<body>

    <header>
        <img src="../imag/bola.png" alt="logo" class="logoheader"></a>

        <nav>
            <ul class="menuPrincipal">
                <li class="botaoMenu">
                    <!--botão logout-->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input class="sair" type="submit" name="logout" value="Sair">
                        <?php
                        if (isset($_POST["logout"])) {
                            logout();
                        }
                        ?>
                    </form>
                </li>
                <li class="botaoMenu">
                    <a href="alteracadastro.php">Seu Cadastro</a>
                </li>
                <li class="botaoMenu">
                    <a href="consultareserva.php">Consulte Suas Resevas</a>
                </li>

            </ul>
        </nav>

    </header>

    <div class="dropdown">
        <button class="mainmenubtn">Selecione a Quadra</button>
        <div class="dropdown-child">
            <a href="#">Quadra 1</a>
            <a href="#">Quadra 2</a>
            <a href="#">Quadra 3</a>
        </div>

    </div>

    <div class="saldacao">
        <?php echo "<p>Olá " . $Nome . "</p>" ?>
    </div>
<!-- Botões de agendamento-->
    <div>

        <div class="menuHorarios">
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Domingo</h1>
                </div>
                <div>
                    <button value="1"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva1 . "</p>" ?></button>
                </div>
                <div>
                    <button value="8"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva8 . "</p>" ?></button>
                </div>
                <div>
                    <button value="15"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva15 . "</p>" ?></button>
                </div>
                <div>
                    <button value="22"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva22 . "</p>" ?></button>
                </div>
                <div>
                    <button value="29"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva29 . "</p>" ?></button>
                </div>
            </div>
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Segunda</h1>
                </div>
                <div>
                    <button value="2"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva2 . "</p>" ?></button>
                </div>
                <div>
                    <button value="9"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva9 . "</p>" ?></button>
                </div>
                <div>
                    <button value="16"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva16 . "</p>" ?></button>
                </div>
                <div>
                    <button value="23"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva23 . "</p>" ?></button>
                </div>
                <div>
                    <button value="30"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva30 . "</p>" ?></button>
                </div>
            </div>

            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Terça</h1>
                </div>
                <div>
                    <button value="3"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva3 . "</p>" ?></button>
                </div>
                <div>
                    <button value="10"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva10 . "</p>" ?></button>
                </div>
                <div>
                    <button value="17"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva17 . "</p>" ?></button>
                </div>
                <div>
                    <button value="24"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva24 . "</p>" ?></button>
                </div>
                <div>
                    <button value="31"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva31 . "</p>" ?></button>
                </div>
            </div>
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Quarta</h1>
                </div>
                <div>
                    <button value="4"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva4 . "</p>" ?></button>
                </div>
                <div>
                    <button value="11"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva11 . "</p>" ?></button>
                </div>
                <div>
                    <button value="18"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva18 . "</p>" ?></button>
                </div>
                <div>
                    <button value="25"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva25 . "</p>" ?></button>
                </div>
                <div>
                    <button value="32"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva32 . "</p>" ?></button>
                </div>
            </div>
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Quinta</h1>
                </div>
                <div>
                    <button value="5"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva5 . "</p>" ?></button>
                </div>
                <div>
                    <button value="12"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva12 . "</p>" ?></button>
                </div>
                <div>
                    <button value="19"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva19 . "</p>" ?></button>
                </div>
                <div>
                    <button value="26"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva26 . "</p>" ?>></button>
                </div>
                <div>
                    <button value="33"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva33 . "</p>" ?></button>
                </div>
            </div>
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Sexta</h1>
                </div>
                <div>
                    <button value="6"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva6 . "</p>" ?></button>
                </div>
                <div>
                    <button value="13"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva13 . "</p>" ?></button>
                </div>
                <div>
                    <button value="20"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva20 . "</p>" ?></button>
                </div>
                <div>
                    <button value="17"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva27 . "</p>" ?></button>
                </div>
                <div>
                    <button value="34"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva34 . "</p>" ?></button>
                </div>
            </div>
            <div class="colunahorarios">
                <div class="diaSemana">
                    <h1>Sabado</h1>
                </div>
                <div>
                    <button value="7"
                        class="horarios"><?php echo "<p>Horas: " . $horas1 . " Horario: " . $reserva7 . "</p>" ?></button>
                </div>
                <div>
                    <button value="14"
                        class="horarios"><?php echo "<p>Horas: " . $horas2 . " Horario: " . $reserva14 . "</p>" ?></button>
                </div>
                <div>
                    <button value="21"
                        class="horarios"><?php echo "<p>Horas: " . $horas3 . " Horario: " . $reserva21 . "</p>" ?></button>
                </div>
                <div>
                    <button value="28"
                        class="horarios"><?php echo "<p>Horas: " . $horas4 . " Horario: " . $reserva28 . "</p>" ?></button>
                </div>
                <div>
                    <button value="35"
                        class="horarios"><?php echo "<p>Horas: " . $horas5 . " Horario: " . $reserva35 . "</p>" ?></button>
                </div>
            </div>
        </div>

        <form action="site.php" method="post">
            <input class="confirmar" type="hidden" name="id_registro" id="id_registro">
            <button class="confirmar" type="submit">Confirmar</button>
            <div class="mensagem">
                <p id="mensagemErro"></p>
            </div>
        </form>

    </div>


    <script>

        //altera cor do botao quando clicado

        var botoes = document.getElementsByClassName('horarios');
        var ultimoBotaoClicado = null;

        for (var i = 0; i < botoes.length; i++) {
            botoes[i].addEventListener('click', function () {
                if (ultimoBotaoClicado) {
                    ultimoBotaoClicado.style.backgroundColor = '';
                }
                ultimoBotaoClicado = this;
                this.style.backgroundColor = 'red';
            });
        }

        //Capitura a informação do botao clicado

        document.addEventListener('DOMContentLoaded', function () {
            var botoes = document.getElementsByClassName('horarios');

            for (var i = 0; i < botoes.length; i++) {
                botoes[i].addEventListener('click', function () {
                    var valor = this.value;

                    console.log(valor);

                    document.getElementById('id_registro').value = valor;
                });
            }


        });
    </script>

    <!--inicia o rodapé-->

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