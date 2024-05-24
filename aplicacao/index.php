 <?php

require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = htmlspecialchars(strip_tags($_POST['Email']));
    $Senha = htmlspecialchars(strip_tags($_POST['Senha']));

    $sql = "SELECT * FROM usuarios WHERE Email = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $Email);
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
                $_SESSION["error"] = "Senha Incorreta!";
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION["error"] = "Usuário Não Encontrado!";
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Erro ao preparar a consulta SQL";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/login.css">
    <title>Login</title>
</head>

<body class="test">
    <!--Cabeçalho do Documento-->
    <header>
        <img src="../imag/bola.png" alt="logo" class="logoheader">

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
                    <p>Crie seu <a href="cadastrar.php">CADASTRO</a> </p>
                </li>

            </ul>
        </nav>

    </header>

    <!--Formulario de Login-->
    <main class="login">
        <form class="form" id="systemLogin" method="post" action="index.php">
            
            
            <h1 class="formHeaderTitle">Faça seu Login</h1>
           
            
            <div class="formBox">
                <label for="Email" class="formLabel">
                E-mail: <input class="formInput" type="email" name="Email" id="Email" placeholder="Seu e-mail:" maxlength="60" required autofocus>
                <img src="../imag/icons8-usuário-48.png" alt="usuario" class="imgLogin">
                </label>
            </div>

            <div class="formBox">
                <label for="Senha" class="formLabel">
                <input class="formInput" type="password" name="Senha" id="Senha" placeholder="Sua senha" maxlength="20" required>
                <img src="../imag/icons8-senha-48.png" alt="senha"><br>
                </label>
            </div>
            <div class="formBox">
                <button class="formButtonSubmit" type="submit" value="logar" title="Clique para efetuar o login">
                    Logar
                </button>
            </div>
            <div class="formBoxExtra" id="formBoxExtra">
                
                <a class="formLinkExtra" href="cadastrar.php">Cadastrar</a>
            </div class="mensagemdeerror">
            <p class="mensagemdeerror"><?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : ""; unset($_SESSION["error"]); ?></p>

        </form>
    </main>

    <!--Rodapé-->

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
