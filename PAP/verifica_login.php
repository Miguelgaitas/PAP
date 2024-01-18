<?php
// Início da sessão
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$email = $_POST['email'];
$senha = md5($_POST['senha']);

// Verificar se o usuário já está registrado e se o status é "verificado"
$sql = "SELECT id, nome, admin, status FROM usuarios WHERE email = '$email' AND senha = '$senha';";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $linha = mysqli_fetch_assoc($resultado);

    if ($linha['status'] === 'verificado') {
        // Armazenamento do ID e do nome do usuário na sessão
        $_SESSION['id_usuario'] = $linha['id'];
        $_SESSION['nome_usuario'] = $linha['nome'];

        if ($linha['admin'] == 1) {
            $_SESSION['isAdmin'] = true;
            $mensagem = "Login bem-sucedido! Esta conta é de admin";
            $redirecionarPara = "primeira_pagina.php";
        } else {
            $_SESSION['isAdmin'] = false;
            $redirecionarPara = "primeira_pagina.php"; 
            $mensagem = "Login bem-sucedido!";
        }

        mysqli_close($conn);

        // Redirecionar para a página de destino com a mensagem na URL
        header("Location: $redirecionarPara?mensagem=" . urlencode($mensagem));
        exit;
    } else {
        // Conta não verificada, redirecionar para a página de login com mensagem de erro
        mysqli_close($conn);
        $mensagem = "Sua conta ainda não foi verificada. Verifique seu e-mail para ativar sua conta.";
        $redirecionarPara = "login.php?mensagem=" . urlencode($mensagem);
        header("Location: $redirecionarPara");
        exit;
    }
} else {
    // E-mail ou senha incorretos
    echo "E-mail ou senha estão incorretos." . mysqli_error($conn);
}

mysqli_close($conn);
?>
