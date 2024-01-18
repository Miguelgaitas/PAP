<?php
// Início da sessão
session_start();
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

// Conexão com o banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

// Verificar se o usuário já está registrado
$sqlVerificar = "SELECT id FROM usuarios WHERE email = '$email';";
$resultadoVerificar = mysqli_query($conn, $sqlVerificar);

if (mysqli_num_rows($resultadoVerificar) > 0) {
    mysqli_close($conn);

    // Redirecionar para a página de registro com a mensagem de e-mail já registrado
    $mensagem = "Este e-mail já está registado.";
    $redirecionarPara = "registro.php?mensagem=" . urlencode($mensagem);

    header("Location: $redirecionarPara");
    exit;
} else {
    // Inserir os dados na tabela de usuários com status "nao_verificado"
    $sqlInserir = "INSERT INTO usuarios (nome, email, senha, status) VALUES ('$nome', '$email', '$senha', 'nao_verificado');";

    if (mysqli_query($conn, $sqlInserir)) {
        // Recupere o nome do usuário do banco de dados
        $sqlBuscarNome = "SELECT nome FROM usuarios WHERE email = '$email';";
        $resultadoBuscarNome = mysqli_query($conn, $sqlBuscarNome);

        if ($resultadoBuscarNome) {
            $row = mysqli_fetch_assoc($resultadoBuscarNome);
            $nomeUsuario = $row['nome'];
        } else {
            $nomeUsuario = "Usuário"; // Defina um valor padrão se não conseguir recuperar o nome
        }

        mysqli_close($conn);

        // Configuração de envio de e-mail usando o MailHog
        ini_set("SMTP", "localhost");
        ini_set("smtp_port", 1025);
        ini_set("sendmail_from", "arduinocodemasters@gmail.com");

        // Envie o e-mail de verificação aqui
        $assunto = "Verificação de Conta";
        $mensagem = "<html>
    <head>
        <style>
        /* Estilos gerais do email */
        body {
        background-color: black;
        background-repeat: repeat;
        background-size: cover;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        }
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            min-width: 96vw;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        h1 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 16px;
            color: #fff;
            line-height: 1.6;
        }
        
        /* Estilos para o botão de redefinição de senha */
        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
            font-weight: bold;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        /* Rodapé do email */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        
        /* Estilos específicos para o link de redefinição de senha */
        .reset-link {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        
        .reset-link:hover {
            text-decoration: underline;
        }
        
        </style>
    </head>
    <body>
    <center>
    <p><img src='http://localhost/PAP/imagens/Capturar-removebg-preview.png' alt='Logo' class='logo-image' style='width: 160px; height: auto;'></p>
        <p>Olá, $nomeUsuario</p>
        <p>Clique no link abaixo para verificar a conta:</p>
        <p><a class='reset-link' href='http://localhost/PAP/verificar_conta.php?email=$email'>Verificar Conta</a></p>
    </center>
    </body>
    </html>";

        mail($email, $assunto, $mensagem, $headers);

        // Redirecionar para a página de login com a mensagem de registro bem-sucedido
        $mensagem = "Registo bem-sucedido! Verifique seu e-mail para ativar sua conta.";
        $redirecionarPara = "login.php?mensagem=" . urlencode($mensagem);

        header("Location: $redirecionarPara");
        exit;
    } else {
        echo "Erro ao registar o Utilizador: " . mysqli_error($conn);
    }
}
?>
