<?php
include("./verificaradm.php");

// Conexão com a base de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Pesquisa de usuários
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT id, nome, email FROM usuarios WHERE nome LIKE '%$search%' OR email LIKE '%$search%'";
} else {
    $sql = "SELECT id, nome, email FROM usuarios";
}

$resultado = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Gestão de Utilizadores </title>
    <style>
    body {
        font-family: 'poppins', sans-serif;
        background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg') repeat;
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        display: flex;
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
        display: block;
        margin-bottom: 20px;
        text-align: center;
        text-decoration: none;
        padding: 10px 20px;
        background-color: #162938;
        color: #fff;
        border-radius: 5px;
    }

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

    /* Estilos para o formulário de pesquisa */
    .search-form {
        margin-bottom: 20px;
        text-align: center;
    }

    .search-form input {
        padding: 10px;
        width: 60%;
        border: 2px solid #162938;
        border-radius: 5px;
        outline: none;
        font-size: 1em;
        color: #162938;
    }

    .search-form button {
        padding: 10px 20px;
        background-color: #162938;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-form button:hover {
        background-color: #fff;
        color: #162938;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Gestão de Utilizadores</h1>
        <a href="pagina_de_admin.php" class="btn">Voltar</a>
        
        <!-- Formulário de pesquisa -->
        <form action="" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Pesquisar por nome ou e-mail">
            <button type="submit">Pesquisar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop através de todos os usuários e exibe suas informações em uma tabela
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $linha['id'] . "</td>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td>" . $linha['email'] . "</td>";
                    echo "<td>";
                    echo "<a href='editarusuario.php?id=" . $linha['id'] . "'>Editar</a> | ";
                    echo "<a href='excluirusuario.php?id=" . $linha['id'] . "'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

