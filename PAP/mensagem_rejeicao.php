<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Mensagem de Verificação</title>
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

        p {
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .action-button {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 20px;
            background-color: #162938;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .action-button:hover {
            background-color: #fff;
            color: #162938;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mensagem de Verificação</h1>
        <p><strong>Mensagem:</strong> <?php echo isset($_GET['mensagem']) ? $_GET['mensagem'] : ''; ?></p>
        <a class="action-button" href="projetos_pendentes.php">Voltar a verificar projetos</a>
    </div>
</body>
</html>