<?php

// Configurações do banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

session_start();

function getProjetos($conn)
{
    $sql = "SELECT * FROM projetos_arduino ORDER BY id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) < 0) {
        return 0;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $nome = $row["nome"];
        $desc = $row["descricao"];
        $img = $row["imagem"];
        $cod = $row["codigo"];

        echo "<div class='projeto'>
                    <h1>$nome</h1>
                    <img src='./imagens/$img'><br>
                    <a  href='projeto.php?id=$id'>Ver Mais</a>
                </div>";
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            background-image: url(https://voenews.com.br/wp-content/uploads/2019/08/Berlengas-Island-_Centrode-Portugal.jpg);
            background-repeat: repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100vw;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .projeto {
            display: flex;
            flex-direction: column;
            border: 1px solid black;
            border-radius: 15px;
            overflow: hidden;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 15px;
            margin: 10px;
            width: 400px;
            height: 500px;
            background-color: rgba(0, 0, 0, 0.01);
            backdrop-filter: blur(6px);
        }

        .projeto h1 {
            margin-top: 10px;
        }

        .projeto img {
            width: 380px;
            height: 320px;
            margin-left: 10px;
            margin-right: 10px;
            background-color: lightblue;
            text-align: center;
            line-height: 200px;
            font-size: 36px;
            color: white;
            border-radius: 5px;
        }

        .projeto * {
            text-decoration: none;
            color: white;
        }
        .add-button {
            text-align: center;
            margin-bottom: 20px;
        }
        .projeto a{
            border-radius: 5px;
            width: 150px;
            height: 25px;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            background-color: rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
        getProjetos($conn);
    ?>
</div>
    
</body>
</html>