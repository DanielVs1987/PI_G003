<?php

require_once "config.php";

//opera logaut
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

//Busca o Nome do usuario

$sql = "SELECT Nome FROM usuarios WHERE Email = $Email";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Nome = $row["Nome"];
    }
} else {
    echo "0 results";
}

//Seleciona horarios

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


};

?>