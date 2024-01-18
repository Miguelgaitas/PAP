<?php
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

$email = $_GET['email'];

// Verificar se o email existe na tabela de usuários
$sqlVerificarEmail = "SELECT id, status FROM usuarios WHERE email = '$email';";
$resultadoVerificarEmail = mysqli_query($conn, $sqlVerificarEmail);

if (mysqli_num_rows($resultadoVerificarEmail) > 0) {
    $row = mysqli_fetch_assoc($resultadoVerificarEmail);
    $status = $row['status'];

    if ($status === 'nao_verificado') {
        // Atualizar o status da conta para "verificado"
        $sqlAtualizarStatus = "UPDATE usuarios SET status = 'verificado' WHERE email = '$email';";
        mysqli_query($conn, $sqlAtualizarStatus);

        mysqli_close($conn);

        // Redirecionar para a página de login com a mensagem de verificação bem-sucedida
        $mensagem = "Sua conta foi verificada com sucesso. Faça login para continuar.";
        $redirecionarPara = "login.php?mensagem=" . urlencode($mensagem);

        header("Location: $redirecionarPara");
        exit;
    } else {
        mysqli_close($conn);

        // Redirecionar para a página de login com a mensagem de conta já verificada
        $mensagem = "Sua conta já foi verificada anteriormente.";
        $redirecionarPara = "login.php?mensagem=" . urlencode($mensagem);

        header("Location: $redirecionarPara");
        exit;
    }
} else {
    mysqli_close($conn);

    // Redirecionar para a página de login com a mensagem de erro
    $mensagem = "Verificação falhou. Por favor, verifique o link ou entre em contato com o suporte.";
    $redirecionarPara = "login.php?mensagem=" . urlencode($mensagem);

    header("Location: $redirecionarPara");
    exit;
}
?>
