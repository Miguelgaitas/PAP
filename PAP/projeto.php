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

if (isset($_GET['id'])) {

    function getProjetos($conn)
    {
        $pid = $_GET['id'];
        $sql = "SELECT * FROM projetos_arduino where id = $pid ORDER BY id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) < 0) {
            return 0;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $nome = $row["nome"];
            $desc = $row["descricao"];
            $cod = $row["codigo"];
            $sim = $row["simula"];

            // Formatar a descrição com quebras de linha adequadas
            $desc_formatada = nl2br($desc);

            echo "<div class='projeto'>
                    <h1>$nome</h1>
                    $sim<br>
                    <p>$desc_formatada</p>
                    <br>
                    <pre>
                        <p>$cod</p>
                    </pre>
                </div>";

        }
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
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;

        }

        body {
            background-image: url(https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        header {
      position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 150px;
			padding: 20px 100px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			z-index: 99;
			backdrop-filter: blur(10px);
			border:2px solid rgba(255,255,255,.5);
	        border-radius:6px;
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
            text-align: left;
            padding: 15px;
            margin-top: 170px;
            width: 620px;
            min-height: 500px;
            background-color: rgb(0, 0, 0, .6);
            backdrop-filter: blur(3px);
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

        .projeto pre {
            display: flex;
            min-width: 300px;
            border: 2px solid gray;
            background-color: rgba(0, 0, 0, 0.35);
            padding: 15px;
            font-weight: 500;
            font-family: 'Source Code Pro', monospace;
        }


        .projeto a {
            border-radius: 5px;
            width: 150px;
            height: 25px;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            background-color: rgba(255, 255, 255, 0.25);
        }
        .logo {
      font-size: 2em;
      color: #fff;
      user-select: none;
    }
    .navigation .btnlogin-popup {
      width: 130px;
      height: 50px;
      background: transparent;
      border: 2px solid #fff;
      outline: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1.1em;
      color: #fff;
      font-weight: 500;
      margin-left: 40px;
      transition: .5s;
    }

    .navigation .btnlogin-popup:hover {
      background: #fff;
      color: #162938;
    }
    </style>
</head>

<body>
    <header>

        <h2 class="logo">
            <img src="./imagens/Capturar-removebg-preview.png" alt="Logo" class="logo-image"
                style="width: 180px; height: auto;">
        </h2>
        <nav class="navigation">
            <button onclick="window.location.href= './pagina1.php';" class="btnlogin-popup">Projetos</button>
        </nav>
    </header>
    <div class="wrapper">
        <?php
        getProjetos($conn);
        ?>
    </div>

</body>

</html>