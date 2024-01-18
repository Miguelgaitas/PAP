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
// Verifica se o ID do projeto foi passado como parâmetro
if(isset($_GET['id'])) {
  $projetoId = $_GET['id'];

  // Consulta o projeto com base no ID
  $sql = "SELECT * FROM projetos_arduino WHERE id = $projetoId";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Exibe os detalhes do projeto a ser excluído
    echo "<h2>Excluir Projeto</h2>";
    echo "<p>Deseja realmente excluir o projeto '".$row['nome']."'?</p>";
    echo "<form action='remover_projeto_comunitarios.php' method='POST'>";
    echo "<input type='hidden' name='projetoId' value='".$row['id']."'>";
    echo "<input type='submit' value='Confirmar Exclusão'>";
    echo "</form>";
  } else {
    echo "Projeto não encontrado.";
  }
} else {
  echo "ID do projeto não fornecido.";
}
?>
