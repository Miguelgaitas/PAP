

<?php
session_start();
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

// Obtém os dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$imagem = $_FILES['imagem']['name'];
$codigo = $_POST['codigo'];
$sim = $_POST['simula'];
// Move a imagem para um diretório do servidor
$targetDir = "./imagens/";
$targetFile = $targetDir . basename($_FILES['imagem']['name']);
if (move_uploaded_file($_FILES['imagem']['tmp_name'], $targetFile)) {
  echo "Imagem enviada com sucesso!<br>";
} else {
  echo "Erro ao enviar a imagem.<br>";
}

$meuID = $_SESSION['id_usuario'];
$sql = "INSERT INTO projetos_arduino (autor, nome, descricao, imagem, codigo, simula) VALUES ('$meuID', '$nome', '$descricao', '$imagem', '$codigo', '$sim')";

if ($conn->query($sql) === TRUE) {
  echo "Projeto adicionado com sucesso!";
} else {
  echo "Erro ao adicionar o projeto: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
<a href="pagina_de_admin.php" style="text-decoration: none;">
    <button type="button" style="padding: 10px 20px; font-size: 16px;">Voltar</button>