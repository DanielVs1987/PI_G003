<?php
    session_start(); 


/*  //conexão db4free
    $servername = "db4free.net";
    $username = "dadosgpi003";
    $password = "@Grupo_PI003@";
    $dbname = "dadosgpi003";
*/
    //conexão xampp
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grupo003_pi";

/*  //conexão 00webhost
    $servername = "localhost";
    $username = "id22157371_grupo003pi";
    $password = "@Grupo_003pi@";
    $dbname = "id22157371_dadospi";
*/

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    } 
    
?>
