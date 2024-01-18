<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o ID do projeto foi enviado por POST
if (isset($_POST['projetoId'])) {
    $projetoId = $_POST['projetoId'];

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $codigo = $_POST['codigo'];
    $sim = $_POST['simula'];

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['imagem']['size'] > 0) {
        $imagem = $_FILES['imagem']['name'];

        // Move a imagem para um diretório do servidor
        $targetDir = "C:\\xampp\\htdocs\\site e base de dados\\imagens\\";
        $targetFile = $targetDir . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $targetFile);

        // Atualiza os dados na tabela do banco de dados, incluindo a nova imagem
        $sql = "UPDATE projetos_arduino SET nome='$nome', descricao='$descricao', imagem='$imagem', codigo='$codigo', simula='$sim', status='pendente', prazo_edicao = NULL WHERE id=$projetoId";
    } else {
        // Atualiza os dados na tabela do banco de dados, sem modificar a imagem
        $sql = "UPDATE projetos_arduino SET nome='$nome', descricao='$descricao', codigo='$codigo', simula='$sim', status='pendente', prazo_edicao = NULL WHERE id=$projetoId";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Projeto atualizado com sucesso! O prazo de edição foi removido.";
    } else {
        echo "Erro ao atualizar o projeto: " . $conn->error;
    }
} else {
    echo "ID do projeto não fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<a href="pagina1.php" style="text-decoration: none;">
    <button type="button" style="padding: 10px 20px; font-size: 16px;">Voltar</button>
</a>
