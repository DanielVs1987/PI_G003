<?php
require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpeza dos dados
    $Email = htmlspecialchars(strip_tags($_POST['Email']));
    $Senha = htmlspecialchars(strip_tags($_POST['Senha']));

    $sql = "SELECT * FROM usuarios WHERE Email = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt ->bind_param("s", $Email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc(); 

            if (password_verify($Senha, $row['Senha'])) {
                $_SESSION["loggedin"] = true; 
                $_SESSION["email"] = $Email; // Armazena o email na sessão
                header("Location: site.php"); 
                exit; 
            } else {
                $error = "Senha incorreta";
                header("Location: index.php"); 
                exit;
            }
        } else {
            $error = "Usuário não encontrado";
            header("Location: index.php"); 
            exit;
        }       
    } else {
        $error = "Erro ao preparar a consulta SQL";
    }
}

$conn->close();

?>
