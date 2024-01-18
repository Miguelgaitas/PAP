
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
    $categoria_nome = isset($_POST["categoria_nome"]) ? $_POST["categoria_nome"] : null;

    // Inserir dados na tabela de categorias
    $sql = "INSERT INTO categorias (nome) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria_nome);

    if ($stmt->execute()) {
        // Success
        echo '<script>';
        echo 'alert("Categoria adicionada com sucesso!");';
        echo '</script>';
    } else {
        // Error
        echo '<script>';
        echo 'alert("Erro ao adicionar categoria: ' . $stmt->error . '");';
        echo '</script>';
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
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

        header {
            background-color: #162938;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        .navigation {
            display: flex;
            justify-content: center;
        }

        .navigation a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        .navigation a:hover {
            text-decoration: underline;
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

        .status-message {
            text-align: center;
            font-weight: bold;
            color: #162938;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="navigation">
                <a href="pagina_de_admin.php">Admin</a>
                <a href="associar_loja_componente.php">Associar componente a Loja</a>
                <a href="adicionar_componente.php">Adicionar Componente</a>
                <a href="associar_componente_categoria.php">Associar Componente a Categoria</a>
            </div>
        </header>
<br>

        <div class="projeto">
            <h1>Adicionar Categoria</h1>
            <form method="post" action="">
                <label for="categoria_nome">Nome da Categoria:</label>
                <input type="text" name="categoria_nome" required>
                <input type="submit" value="Adicionar Categoria">
            </form>
        </div>
    </div>
</body>

</html>