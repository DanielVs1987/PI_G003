<?php

    require_once "config.php"; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Nome = $_POST["Nome"];
        $Email = $_POST["Email"];
        $Telefone = $_POST["Telefone"];
        $Nascimento = $_POST["Nascimento"];
        $Senha = $_POST["Senha"];
        $hashed_Senha = password_hash($Senha, PASSWORD_DEFAULT);


        $sql = "INSERT INTO usuarios (Nome, Email, Telefone, Nascimento, Senha) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("sssss", $Nome, $Email, $Telefone, $Nascimento, $hashed_Senha); 

        if ($stmt->execute()) {
            echo "Usuário criado com sucesso";
            header("Refresh:3; url=index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . $coon->error;
        };
        
        

       

    }
    $conn->close();

