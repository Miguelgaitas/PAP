<?php
session_start();
include("conexao.php"); // Conexão com o banco de dados
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

$email = $_POST['email'];

// Verifique se o e-mail existe no banco de dados
$sql = "SELECT id, nome FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    $usuario_id = $row['id'];
    $nomeUsuario = $row['nome'];

    // Crie um token de redefinição de senha
    $token = bin2hex(random_bytes(32)); // Gere um token aleatório
    $expiracao = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expira em 1 hora

    // Insira o token no banco de dados
    $sql = "INSERT INTO tokens_reset_senha (usuario_id, token, expiracao) VALUES ($usuario_id, '$token', '$expiracao')";
    mysqli_query($conexao, $sql);

    // Configuração de envio de e-mail
    ini_set("SMTP", "localhost");
    ini_set("smtp_port", 1025);
    ini_set("sendmail_from", "arduinocodemasters@gmail.com");

    // Envie um e-mail com um link de redefinição de senha
    $assunto = "Redefinição de Senha";
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
        <p>Olá $nomeUsuario,</p>
        <p>Recebeu um pedido para redefinir a sua senha. Clique no link abaixo para redefinir a sua senha</p>
        <p><a class='reset-link' href='http://localhost/PAP/reset_password.php?token=$token'>Redefinir Senha</a></p>
        <p>Se não pediu esta reposição, por favor, ignore este e-mail</p>
        </center>
    </body>
    </html>";



    mail($email, $assunto, $mensagem, $headers);

    $_SESSION['mensagem'] = "E-mail de redefinição de senha enviado com sucesso!";
} else {
    $_SESSION['mensagem'] = "E-mail não encontrado em nossa base de dados.";
}

header("Location: forgot_password.php");
?>
