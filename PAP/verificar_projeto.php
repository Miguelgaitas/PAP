<?php
include("./verificaradm.php");

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

// Conexão com o banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o ID do projeto foi passado via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $projetoId = $_GET['id'];

    // Consulta para recuperar informações do projeto específico
    $sql = "SELECT * FROM projetos_arduino WHERE id = $projetoId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $descricao = $row["descricao"];
        $imagem = $row["imagem"];
        $simulacao = $row["simula"];
        $codigo = $row["codigo"];
        $autorId = $row["autor"];
        // Adicione outras informações relevantes aqui

        // Verifique se a ação (verificar, rejeitar ou excluir) foi passada via GET
        if (isset($_GET['acao'])) {
            $acao = $_GET['acao'];

            if ($acao === "verificar") {
                // Atualize o status para "verificado"
                $atualizarSql = "UPDATE projetos_arduino SET status = 'verificado' WHERE id = $projetoId";
                if ($conn->query($atualizarSql) === TRUE) {
                    // Envie um email ao autor do projeto
                    enviarEmail($autorId, "Projeto Verificado", "Seu projeto '$nome' foi verificado com sucesso!", $headers);

                    header("Location: mensagem_verificacao.php?mensagem=Projeto '$nome' verificado com sucesso!");
                    exit();
                } else {
                    header("Location: mensagem_verificacao.php?mensagem=Erro ao verificar o projeto: " . $conn->error);
                    exit();
                }
            } elseif ($acao === "rejeitar") {
                // Atualize o status para "rejeitado"
                $atualizarSql = "UPDATE projetos_arduino SET status = 'rejeitado' WHERE id = $projetoId";
                if ($conn->query($atualizarSql) === TRUE) {
                    // Defina o prazo de edição para 1 semana (60 segundos * 60 minutos * 24 horas * 7 dias)
                    $prazoEdicao = time() + (60 * 60 * 24 * 7);

                    // Atualize o prazo de edição na base de dados
                    $atualizarPrazoSql = "UPDATE projetos_arduino SET prazo_edicao = FROM_UNIXTIME($prazoEdicao) WHERE id = $projetoId";

                    if ($conn->query($atualizarPrazoSql) !== TRUE) {
                        echo "Erro ao definir o prazo de edição: " . $conn->error;
                    } else {
                        // Envie um email ao autor do projeto
                        enviarEmail($autorId, "Projeto Rejeitado", "Seu projeto '$nome' foi rejeitado. Você tem até " . date('d/m/Y H:i:s', $prazoEdicao) . " para fazer as edições necessárias.", $headers);

                        // Redirecione para a página de mensagem de rejeição
                        header("Location: mensagem_rejeicao.php?mensagem=Projeto '$nome' Rejeitado com sucesso!");
                        exit();
                    }
                } else {
                    echo "Erro ao rejeitar o projeto: " . $conn->error;
                }
            } elseif ($acao === "excluir") {
                // Lógica para excluir o projeto e enviar e-mail
                $excluirProjetoSql = "DELETE FROM projetos_arduino WHERE id = $projetoId";
            
                $obterComponentesSql = "SELECT pc.componente_id, c.quantidade_utilizada, c.nome as componente_nome 
                            FROM projetos_componentes pc 
                            INNER JOIN componentes c ON pc.componente_id = c.id
                            WHERE pc.projeto_id = ?";

    // Preparar a instrução SQL
    $stmt = $conn->prepare($obterComponentesSql);

    // Verifique se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular o parâmetro e executar a consulta
        $stmt->bind_param("i", $projetoId);
        $stmt->execute();

        // Obter o resultado da consulta
        $resultComponentes = $stmt->get_result();

        // Atualizar a quantidade_utilizada na tabela componentes
        while ($rowComponente = $resultComponentes->fetch_assoc()) {
            $componenteId = $rowComponente['componente_id'];
            $quantidadeUtilizada = $rowComponente['quantidade_utilizada'];
            $componenteNome = $rowComponente['componente_nome'];

            // Atualizar a quantidade_utilizada subtraindo a quantidade utilizada no projeto
            $novaQuantidade = max(0, $quantidadeUtilizada - 1);

            $atualizarQuantidadeSql = "UPDATE componentes SET quantidade_utilizada = $novaQuantidade WHERE id = $componenteId";

            if ($conn->query($atualizarQuantidadeSql) !== TRUE) {
                // Lidar com erros ao atualizar a quantidade
                echo "Erro ao atualizar a quantidade do componente $componenteNome: " . $conn->error;
            }
        }

        // Excluir o projeto e enviar e-mail
        $excluirProjetoSql = "DELETE FROM projetos_arduino WHERE id = $projetoId";

        // Delete associated records in projetos_componentes
        $excluirComponentesSql = "DELETE FROM projetos_componentes WHERE projeto_id = $projetoId";
        if ($conn->query($excluirComponentesSql) !== TRUE) {
            echo "Erro ao excluir componentes do projeto: " . $conn->error;
            // Handle the error as needed
        }

        if ($conn->query($excluirProjetoSql) === TRUE) {
            // Envie um email ao autor informando a exclusão
            enviarEmail($autorId, "Projeto Excluído", "Seu projeto '$nome' foi excluído devido a violações das normas.", $headers);

            header("Location: mensagem_exclusao.php?mensagem=Projeto '$nome' excluído com sucesso!");
            exit();
        } else {
            header("Location: mensagem_exclusao.php?mensagem=Erro ao excluir o projeto: " . $conn->error);
            exit();
        }
    } else {
        // Tratar o erro de preparação da consulta
        echo "Erro na preparação da consulta: " . $conn->error;
    }
            }
        } 
    } else {
        echo "Projeto não encontrado.";
    }
} else {
    echo "ID do projeto inválido.";
}

// Função para enviar email
function enviarEmail($autorId, $assunto, $mensagem, $headers)
{
    // Configurações do servidor SMTP (MailHog local)
    $smtpHost = 'localhost'; // Ou 'localhost'
    $smtpPort = 1025; // Porta padrão do MailHog

    // Configuração do servidor SMTP
    ini_set('SMTP', $smtpHost);
    ini_set('smtp_port', $smtpPort);

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "id20757658_miguelgaitas";
    $password = "MiguelGaitas24.";
    $dbname = "id20757658_dados_dos_registros";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta para obter o nome do autor
    $sql = "SELECT email, nome FROM usuarios WHERE id = $autorId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $emailAutor = $row["email"];
        $nomeAutor = $row["nome"];
    } else {
        $emailAutor = "emaildesconhecido@example.com";
        $nomeAutor = "Autor Desconhecido";
    }

    // Configurações de email
    $to = $emailAutor;

    $nomeAutor = htmlspecialchars($nomeAutor, ENT_QUOTES, 'UTF-8');
    $headers .= 'From: arduinocodmasters@gmail.com' . "\r\n" .
        'Reply-To: remetente@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Conteúdo do email
    $conteudo = "
    <html>
        <head>
            <style>
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

            .footer {
                margin-top: 20px;
                text-align: center;
                font-size: 14px;
                color: #777;
            }

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
                <h1>Olá " . htmlspecialchars($nomeAutor, ENT_QUOTES, 'UTF-8') . ",</h1>
                <p>" . $mensagem . "</p>
            </center>
        </body>
    </html>";

    // Envie o email
    mail($to, $assunto, $conteudo, $headers);

    // Feche a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Verificar Projeto</title>
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

        h1 {
            text-align: center;
            margin-bottom: 20px;
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
        <h1>Detalhes do Projeto</h1>
        <p><strong>Nome:</strong>
            <?php echo isset($nome) ? $nome : ''; ?>
        </p>
        <p><strong>Descrição:</strong>
            <?php echo isset($descricao) ? $descricao : ''; ?>
        </p>
        <p><strong>Imagem:</strong><br><img src='./imagens/<?php echo isset($imagem) ? $imagem : ''; ?>'
                alt="Imagem do Projeto">
        </p>
        <p><strong>Simulação:</strong><br>
            <?php echo isset($simulacao) ? $simulacao : ''; ?>
        </p>
        <p><strong>Código:</strong>
            <?php echo isset($codigo) ? $codigo : ''; ?>
        </p>

        <h2>Ações</h2>
        <a class="action-button" href="verificar_projeto.php?id=<?php echo $projetoId; ?>&acao=verificar">Verificar
            Projeto</a>
        <a class="action-button" href="verificar_projeto.php?id=<?php echo $projetoId; ?>&acao=rejeitar">Rejeitar
            Projeto</a>
        <a class="action-button" href="verificar_projeto.php?id=<?php echo $projetoId; ?>&acao=excluir">Excluir
            Projeto</a>
    </div>
</body>

</html>