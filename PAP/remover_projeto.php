<?php
include("./verificaradm.php");
?>
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

  // Obtém o nome do arquivo da imagem do projeto
  $sql = "SELECT imagem FROM projetos_arduino WHERE id = $projetoId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagem = $row['imagem'];

    // Remove o projeto do banco de dados
    $sql = "DELETE FROM projetos_arduino WHERE id = $projetoId";
    if ($conn->query($sql) === TRUE) {
      // Remove a imagem do arquivo
      $caminhoImagem = "C:\\xampp\\htdocs\\site e base de dados\\imagens\\" . $imagem;
      if (file_exists($caminhoImagem)) {
        unlink($caminhoImagem);
        echo "Projeto removido com sucesso!";
      } else {
        echo "Imagem não encontrada.";
      }
    } else {
      echo "Erro ao remover o projeto: " . $conn->error;
    }
  } else {
    echo "Projeto não encontrado.";
  }
} else {
  echo "ID do projeto não fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<a href="pagina_de_admin.php" style="text-decoration: none;">
    <button type="button" style="padding: 10px 20px; font-size: 16px;">Voltar</button>
</a>
