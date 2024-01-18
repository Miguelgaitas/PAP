<?php
include("./verificaradm.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "id20757658_miguelgaitas";
    $password = "MiguelGaitas24.";
    $dbname = "id20757658_dados_dos_registros";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Receber os dados do formulário
    $nome = $_POST["nome"];
    // Definindo a quantidade utilizada como 0
    $quantidade_utilizada = 0;

    // Inserir dados na tabela componentes
    $sql = "INSERT INTO componentes (nome, quantidade_utilizada) VALUES ('$nome', $quantidade_utilizada)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Componente adicionado com sucesso!");';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Erro ao adicionar componente: ' . $conn->error . '");';
        echo '</script>';
    }

    // Fechar a conexão
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Componente</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg') repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
        }

        .projeto {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input,
        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #162938;
            border-radius: 5px;
            outline: none;
            font-size: 1em;
            color: #162938;
        }

        input[type="submit"] {
            background-color: #162938;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #fff;
            color: #162938;
        }

        .navigation {
            display: flex;
            justify-content: center;
            background-color: #162938;
            padding: 10px;
        }

        .navigation a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }

        .navigation a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="navigation">
                <a href="pagina_de_admin.php">Admin</a>
                <a href="associar_loja_componente.php">Associar componente a Loja</a>
                <a href="associar_componente_categoria.php">Associar Componente a Categoria</a>
                <a href="adicionar_categoria.php">Adicionar Categoria</a>
            </div>
            <br>
        </header>

        <div class="projeto">
            <h1>Adicionar Componente</h1>
            <form method="post" action="">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>
                <!-- Definindo a quantidade utilizada como 0 -->
                <input type="hidden" name="quantidade_utilizada" value="0">
                <input type="submit" value="Adicionar Componente">
            </form>
        </div>
    </div>
</body>

</html>
