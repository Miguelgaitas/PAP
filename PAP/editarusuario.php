<?php
// Conexão com a base de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se foi passado o ID do usuário
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Seleciona o usuário da base de dados
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($resultado) > 0) {
        $linha = mysqli_fetch_assoc($resultado);
    } else {
        echo "Usuário não encontrado.";
        exit;
    }
} else {
    echo "ID do usuário não informado.";
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    // Atualiza os dados do usuário na base de dados
    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";
    mysqli_query($conn, $sql);

    // Redireciona de volta para a página de gerenciamento de usuários
    header("Location: adminusuarios.php");
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Editar Usuário</title>
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
        max-width: 400px;
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

    form {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #162938;
    }

    input {
        width: 80%;
        padding: 10px;
        margin-bottom: 15px;
        border: 2px solid #162938;
        border-radius: 5px;
        outline: none;
        font-size: 1em;
        color: #162938;
    }

    input[type="submit"] {
        background-color: #162938;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #fff;
        color: #162938;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Editar Utilizador</h1>
        <form method="post">
            <label for="nome">Nome :</label>
            <input type="text" name="nome" value="<?php echo $linha['nome']; ?>"><br>

            <label for="email">E-mail :</label>
            <input type="email" name="email" value="<?php echo $linha['email']; ?>"><br>

            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
