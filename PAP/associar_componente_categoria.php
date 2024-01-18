<?php

include("./verificaradm.php");
// Conexão com o banco de dados (substitua as credenciais conforme necessário)
$conn = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Função para obter o ID de uma categoria com base no nome
function obterIdCategoria($conn, $nomeCategoria)
{
    $sql = "SELECT id FROM categorias WHERE nome = '$nomeCategoria'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return null;
    }
}

// Função para obter o ID de um componente com base no nome
function obterIdComponente($conn, $nomeComponente)
{
    $sql = "SELECT id FROM componentes WHERE nome = '$nomeComponente'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return null;
    }
}

// Obtém a lista de componentes do banco de dados
$sqlComponentes = "SELECT nome FROM componentes ORDER BY nome";
$resultComponentes = mysqli_query($conn, $sqlComponentes);
$listaComponentes = mysqli_fetch_all($resultComponentes, MYSQLI_ASSOC);

// Obtém a lista de categorias do banco de dados
$sqlCategorias = "SELECT nome FROM categorias ORDER BY nome";
$resultCategorias = mysqli_query($conn, $sqlCategorias);
$listaCategorias = mysqli_fetch_all($resultCategorias, MYSQLI_ASSOC);

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeComponente = $_POST["nome_componente"];
    $nomeCategoria = $_POST["nome_categoria"];

    // Obtém os IDs dos componentes e categorias
    $idComponente = obterIdComponente($conn, $nomeComponente);
    $idCategoria = obterIdCategoria($conn, $nomeCategoria);

    // Verifica se os IDs foram obtidos com sucesso
    if ($idComponente !== null && $idCategoria !== null) {
        // Realiza a associação
        $sqlAssociacao = "INSERT INTO componentes_categorias (componente_id, categoria_id) VALUES ($idComponente, $idCategoria)";
        $resultAssociacao = mysqli_query($conn, $sqlAssociacao);

        if ($resultAssociacao) {
            echo '<script>';
            echo 'alert("Associação bem-sucedida!");';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Erro ao associar componente à categoria: ' . mysqli_error($conn) . '");';
            echo '</script>';
        }
    }
}
// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associar Componente a Categoria</title>
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

        select {
            width: 100%;
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
    </style>
</head>

<body>

    <div class="wrapper">
        <header>
            <div class="navigation">
                <a href="pagina_de_admin.php">Admin</a>
                <a href="associar_loja_componente.php">Associar componente a Loja</a>
                <a href="adicionar_componente.php">Adicionar Componente</a>
                <a href="adicionar_categoria.php">Adicionar Categoria</a>
            </div>
            <br>
        </header>

        <div class="projeto">
            <h1>Associar Componente a Categoria</h1>
            <form method="post" action="">
                <label for="nome_componente">Nome do Componente:</label>
                <select name="nome_componente" required>
                    <?php
                    // Exibe as opções da lista suspensa para componentes
                    foreach ($listaComponentes as $componente) {
                        echo '<option value="' . $componente['nome'] . '">' . $componente['nome'] . '</option>';
                    }
                    ?>
                </select>
                <label for="nome_categoria">Nome da Categoria:</label>
                <select name="nome_categoria" required>
                    <?php
                    // Exibe as opções da lista suspensa para categorias
                    foreach ($listaCategorias as $categoria) {
                        echo '<option value="' . $categoria['nome'] . '">' . $categoria['nome'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Associar Componente à Categoria">
            </form>
        </div>
    </div>
</body>

</html>
