
<?php

include("./verificaradm.php");
// Inicializa a variável $statusMensagem
$statusMensagem = '';

// Conexão com o banco de dados (substitua as credenciais conforme necessário)
$conn = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Função para obter o ID de uma loja com base no nome
function obterIdLoja($conn, $nomeLoja)
{
    $sql = "SELECT id FROM lojas WHERE nome = '$nomeLoja'";
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

// Obtém a lista de lojas do banco de dados
$sqlLojas = "SELECT nome FROM lojas ORDER BY nome";
$resultLojas = mysqli_query($conn, $sqlLojas);
$listaLojas = mysqli_fetch_all($resultLojas, MYSQLI_ASSOC);

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeComponente = $_POST["nome_componente"];
    $nomeLoja = $_POST["nome_loja"];

    // Obtém os IDs dos componentes e lojas
    $idComponente = obterIdComponente($conn, $nomeComponente);
    $idLoja = obterIdLoja($conn, $nomeLoja);

    // Verifica se os IDs foram obtidos com sucesso
    if ($idComponente !== null && $idLoja !== null) {
        // Realiza a associação
        $sqlAssociacao = "INSERT INTO loja_componente (loja_id, componente_id) VALUES ($idLoja, $idComponente)";
        $resultAssociacao = mysqli_query($conn, $sqlAssociacao);

        if ($resultAssociacao) {
            $statusMensagem = "Associação bem-sucedida!";
            echo '<script>';
            echo 'alert("' . $statusMensagem . '");';
            echo '</script>';
        } else {
            $statusMensagem = "Erro ao associar loja ao componente: " . mysqli_error($conn);
            echo '<script>';
            echo 'alert("' . $statusMensagem . '");';
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
    <title>Associar Loja a Componente</title>
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
                <a href="adicionar_categoria.php">Adicionar Categoria</a>
                <a href="adicionar_componente.php">Adicionar Componente</a>
                <a href="associar_componente_categoria.php">Associar Componente a Categoria</a>
            </div>
        </header>
        <div class="projeto">
            <h1>Associar Loja a Componente</h1>
            <?php echo '<p class="status-message">' . $statusMensagem . '</p>'; ?>
            <form method="post" action="associar_loja_componente.php">
                <label for="nome_componente">Nome do Componente:</label>
                <select name="nome_componente" required>
                    <?php
                    // Exibe as opções da lista suspensa para componentes
                    foreach ($listaComponentes as $componente) {
                        echo '<option value="' . $componente['nome'] . '">' . $componente['nome'] . '</option>';
                    }
                    ?>
                </select>
                <label for="nome_loja">Nome da Loja:</label>
                <select name="nome_loja" required>
                    <?php
                    // Exibe as opções da lista suspensa para lojas
                    foreach ($listaLojas as $loja) {
                        echo '<option value="' . $loja['nome'] . '">' . $loja['nome'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Associar Loja ao Componente">
            </form>
        </div>
    </div>
</body>

</html>