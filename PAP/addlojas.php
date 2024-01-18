<?php include("./verificaradm.php"); ?> 
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Adicionar loja</title>
    <style>
        /* Definições gerais */
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

        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            width: 95%;
            display: block;
            margin-bottom: 20px;
            text-align: center;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #162938;
            color: #fff;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #fff;
            color: #162938;
        }

        /* Estilo para o formulário de adição de loja */
        form {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input,
        form textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #162938;
            border-radius: 5px;
            outline: none;
            font-size: 1em;
            color: #162938;
        }

        form input[type="submit"] {
            background-color: #162938;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #fff;
            color: #162938;
        }
        /* Estilo para as tabelas */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #162938;
    color: #fff;
}

tr:hover {
    background-color: #f5f5f5;
}
label {
    display: block;
    margin-bottom: 8px;
}

input[type="checkbox"] {
    margin-right: 8px; /* Ajuste a margem conforme necessário para posicionar a caixa de seleção */
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar loja</h1>
        <a href="pagina_de_admin.php" class="btn">Voltar para a página de administração</a>

        <!-- Formulário de adição de loja -->
        <form method="post" action="adicionar_loja.php">
            <label for="nome">Nome da loja:</label>
            <input type="text" name="nome" id="nome"><br>

            <label for="endereco">Morada:</label>
            <input type="text" name="endereco" id="endereco"><br>

            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade"><br>

            <label for="codigo_postal">Código postal:</label>
            <input type="text" name="codigo_postal" id="codigo_postal"><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone"><br>
            <h1>Lista de lojas</h1>

<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Endereço</th>
      <th>Cidade</th>
      <th>Código postal</th>
      <th>Telefone</th>
      <th>Produtos disponíveis</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Verificar a conexão
if (!$conexao) {
    die("A conexão falhou: " . mysqli_connect_error());
}

// Selecionar todas as lojas
$query = "SELECT * FROM lojas";
$resultado = mysqli_query($conexao, $query);

// Exibir as informações de cada loja
while ($loja = mysqli_fetch_assoc($resultado)) {
    echo '<tr>';
    echo '<td>' . $loja['nome'] . '</td>';
    echo '<td>' . $loja['endereco'] . '</td>';
    echo '<td>' . $loja['cidade'] . '</td>';
    echo '<td>' . $loja['codigo_postal'] . '</td>';
    echo '<td>' . $loja['telefone'] . '</td>';
    echo '<td>';
    // Selecionar os componentes disponíveis na loja atual
    $query_componentes = "SELECT componentes.nome FROM componentes INNER JOIN loja_componente ON componentes.id = loja_componente.componente_id WHERE loja_componente.loja_id = " . $loja['id'];
    $resultado_componentes = mysqli_query($conexao, $query_componentes);
    // Exibir os nomes dos componentes separados por vírgula
    while ($componente = mysqli_fetch_assoc($resultado_componentes)) {
        echo $componente['nome'] . ', ';
    }
    echo '</td>';
    echo '<td><a href="editar_loja.php?id=' . $loja['id'] . '">Editar</a></td>';
    echo '</tr>';
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>

              

  </tbody>
</table>
            <br>
            <input type="submit" value="Adicionar loja">
        </form>
    </div>
</body>
</html>
