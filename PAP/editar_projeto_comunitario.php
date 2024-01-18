<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="./imagens/favicon-32x32.png">
  <title>Editar Projeto Arduino</title>
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

    .modal {
      width: 80%;
      max-width: 800px;
      margin: 20px auto;
      background: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .modal__header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .modal__title {
      font-size: 24px;
      color: #162938;
    }

    .button--icon {
      background: none;
      border: none;
      cursor: pointer;
    }

    .modal__body {
      margin-bottom: 20px;
    }

    .input__description {
      color: #162938;
    }

    .input__label {
      display: block;
      margin-top: 10px;
      color: #162938;
    }

    .input__field {
      width: 95%;
      padding: 10px;
      margin-bottom: 10px;
      border: 2px solid #162938;
      border-radius: 5px;
      outline: none;
      font-size: 1em;
      color: #162938;
    }

    .modal__footer {
      text-align: center;
    }

    .button--primary {
      background-color: #162938;
      color: #fff;
      cursor: pointer;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }

    .button--primary:hover {
      background-color: #fff;
      color: #162938;
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
  if (isset($_GET['id'])) {
    $projetoId = $_GET['id'];

    // Consulta o projeto com base no ID
    $sql = "SELECT * FROM projetos_arduino WHERE id = $projetoId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();

      echo "<div class='modal'>";
      echo "    <div class='modal__header'>";
      echo "        <span class='modal__title'>Editar Projeto</span><button class='button button--icon' onclick='window.history.back()'>";
      echo "            <svg width='24' height='24' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>";
      echo "                <path fill='none' d='M0 0h24v24H0V0z'></path>";
      echo "                <path d='M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z'></path>";
      echo "            </svg>";
      echo "        </button>";
      echo "    </div>";
      echo "    <div class='modal__body'>";
      echo "        <form action='atualizar_projeto.php' method='POST' enctype='multipart/form-data'>";
      echo "            <p class='input__description'>Deve conter um nome específico do projeto</p>";
      echo "            <label for='nome' class='input__label'>Nome do Projeto:</label><br>";
      echo "            <input type='text' id='nome' name='nome' class='input__field' value='" . htmlspecialchars($row['nome']) . "' required><br><br>";
      echo "            <p class='input__description'>Deve conter uma descrição passo a passo de como se fez o projeto ou seja o código</p>";
      echo "            <label for='descricao' class='input__label'>Descrição:</label><br>";
      echo "            <textarea id='descricao' name='descricao' class='input__field' required>" . htmlspecialchars($row['descricao']) . "</textarea><br><br>";
      echo "            <p class='input__description'>Deve conter uma imagem do projeto</p>";
      echo "            <label for='imagem' class='input__label'>Imagem:</label><br>";
      echo "            <input type='file' id='imagem' name='imagem' class='input__field'><br><br>";
      echo "            <p class='input__description'>Deve conter o código do projeto do Arduino</p>";
      echo "            <label for='codigo' class='input__label'>Código:</label><br>";
      echo "            <textarea id='codigo' name='codigo' class='input__field' required>" . htmlspecialchars($row['codigo']) . "</textarea><br><br>";
      echo "            <p class='input__description'>Tem de ser o código da simulação embebido do Tinkercad que se pode arranjar quando o projeto é público, em seguida vá em partilhar e copie o código </p>";
      echo "            <label for='simula' class='input__label'>Simulação:</label><br>";
      echo "            <textarea id='simula' name='simula' class='input__field' required>" . htmlspecialchars($row['simula']) . "</textarea><br><br>";

      // Consulta todos os componentes da tabela componentes
      $sqlComponentes = "SELECT id, nome FROM componentes";
      $resultComponentes = $conn->query($sqlComponentes);

      if ($resultComponentes->num_rows > 0) {
        echo "<p class='input__description'>Selecione os componentes utilizados no projeto:</p>";
        while ($rowComponente = $resultComponentes->fetch_assoc()) {
          $componenteID = $rowComponente['id'];
          $componenteNome = $rowComponente['nome'];
          $isChecked = ''; // Verifica se o componente está selecionado

          // Verifica se o componente está associado ao projeto
          $sqlCheckComponente = "SELECT * FROM projetos_componentes WHERE projeto_id = '$projetoId' AND componente_id = '$componenteID'";
          $resultCheckComponente = $conn->query($sqlCheckComponente);

          if ($resultCheckComponente->num_rows > 0) {
            $isChecked = 'checked';
          }

          echo "<input type='checkbox' name='componentes[]' value='$componenteID' $isChecked>";
          echo "<label>$componenteNome</label><br>";
        }
      }

      echo "            <div class='modal__footer'>";
      echo "                <input type='hidden' name='projeto_id' value='$projetoId'>";
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