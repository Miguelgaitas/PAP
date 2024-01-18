<?php


include("./verificaradm.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
  <title>Editar Projeto Arduino</title>
  <style>
  body {
    justify-content: center;
    align-items: center;
    background-repeat: repeat;
    min-height: 100vh;
    background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg')repeat;
    background-size: cover;
    background-position: center;
    }

    .button {
      appaerance: none;
      font: inherit;
      border: none;
      background: none;
      cursor: pointer;
    }

    .container {
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    .modal {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      width: 100%;
      max-width: 500px;
      background-color: #fff;
      box-shadow: 0 15px 30px 0 rgba(0, 125, 171, 0.15);
      border-radius: 10px;
    }

    .modal__header {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .modal__body {
      padding: 1rem 1rem;
    }

    .modal__footer {
      padding: 0 1.5rem 1.5rem;
    }

    .modal__title {
      font-weight: 700;
      font-size: 1.25rem;
    }

    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: 0.15s ease;
    }

    .button--icon {
      width: 2.5rem;
      height: 2.5rem;
      background-color: transparent;
      border-radius: 0.25rem;
    }

    .button--icon:focus,
    .button--icon:hover {
      background-color: #ededed;
    }

    .button--primary {
      background-color: #007dab;
      color: #FFF;
      padding: 0.75rem 1.25rem;
      border-radius: 0.25rem;
      font-weight: 500;
      font-size: 0.875rem;
    }

    .button--primary:hover {
      background-color: #006489;
    }

    .input {
      display: flex;
      flex-direction: column;
    }

    .input+.input {
      margin-top: 1.75rem;
    }

    .input__label {
      font-weight: 700;
      font-size: 0.875rem;
    }

    .input__field {
      display: block;
      margin-top: 0.5rem;
      border: 1px solid #DDD;
      border-radius: 0.25rem;
      padding: 0.75rem 0.75rem;
      transition: 0.15s ease;
    }

    .input__field:focus {
      outline: none;
      border-color: #007dab;
      box-shadow: 0 0 0 1px #007dab, 0 0 0 4px rgba(0, 125, 171, 0.25);
    }

    .input__field--textarea {
      min-height: 100px;
      max-width: 100%;
    }

    .input__description {
      font-size: 0.875rem;
      margin-top: 0.5rem;
      color: #8d8d8d;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }
    h1{
      color: white;
    }

    img {
      max-width: 100px;
      max-height: 100px;
    }

    a {
      color: #4CAF50;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Estilo para a célula da imagem */
    td.img-cell {
      text-align: center;
    }

    td.img-cell img {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
</head>
<body>
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

    // Exibe o formulário de edição preenchido com os dados do projeto
    echo "<div class='modal'>";
    echo "    <div class='modal__header'>";
    echo "        <span class='modal__title'>Novo Projeto</span><button class='button button--icon' onclick='window.history.back()'>";
    echo "            <svg width='24' height='24' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>";
    echo "                <path fill='none' d='M0 0h24v24H0V0z'></path>";
    echo "                <path d='M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z'></path>";
    echo "            </svg>";
    echo "        </button>";
    echo "    </div>";
    echo "    <div class='modal__body'>";
    echo "        <form action='adicionar_projeto_comunitario.php' method='POST' enctype='multipart/form-data'>";
    echo "            <p class='input__description'>Deve conter um nome específico do projeto</p>";
    echo "            <label for='nome' class='input__label'>Nome do Projeto:</label>";
    echo "            <input type='text' id='nome' name='nome' class='input__field' value='" . htmlspecialchars($row['nome']) . "' required><br><br>";
    echo "            <p class='input__description'>Deve conter uma descrição passo a passo de como se fez o projeto ou seja o código</p>";
    echo "            <label for='descricao' class='input__label'>Descrição:</label><br>";
    echo "            <textarea id='descricao' name='descricao' class='input__field' required>" . htmlspecialchars($row['descricao']) . "</textarea><br><br>";
    echo "            <p class='input__description'>Deve conter uma imagem do projeto</p>";
    echo "            <label for='imagem' class='input__label'>Imagem:</label>";
    echo "            <input type='file' id='imagem' name='imagem' class='input__field' required><br><br>";
    echo "            <p class='input__description'>Deve conter o código do projeto do Arduino</p>";
    echo "            <label for='codigo' class='input__label'>Código:</label><br>";
    echo "            <textarea id='codigo' name='codigo' class='input__field' required>" . htmlspecialchars($row['codigo']) . "</textarea><br><br>";
    echo "            <p class='input__description'>Tem de ser o código da simulação embebido do Tinkercad que se pode arranjar quando o projeto é público, em seguida vá em partilhar e copie o código </p>";
    echo "            <label for='simula' class='input__label'>Simulação:</label><br>";
    echo "            <textarea id='simula' name='simula' class='input__field' required>" . htmlspecialchars($row['simula']) . "</textarea><br><br>";
    echo "            <div class='modal__footer'>";
    echo "                <button class='button button--primary' type='submit'>Atualizar Projeto</button>";
    echo "            </div>";
    echo "        </form>";
    echo "    </div>";
    echo "</div>";
    
  } else {
    echo "Projeto não encontrado.";
  }
} else {
  echo "ID do projeto não fornecido.";
}
?>
<br><br>

</body>
</html>