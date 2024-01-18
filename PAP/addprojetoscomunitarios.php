<?php
if (!isset($_SESSION)) {
  session_start();
}
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

// Consulta para obter todas as categorias e componentes
$sqlCategorias = "SELECT id, nome FROM categorias";
$resultCategorias = $conn->query($sqlCategorias);

// Armazenar os resultados em um array associativo
$categorias = array();
while ($rowCategoria = $resultCategorias->fetch_assoc()) {
    $categoriaID = $rowCategoria['id'];
    $categorias[$categoriaID] = array(
        'nome' => $rowCategoria['nome'],
        'componentes' => array()
    );

    // Consulta para obter componentes da categoria
    $sqlComponentes = "SELECT c.id, c.nome FROM componentes c
                      JOIN componentes_categorias cc ON c.id = cc.componente_id
                      WHERE cc.categoria_id = '$categoriaID'";
    $resultComponentes = $conn->query($sqlComponentes);

    // Armazenar os componentes no array da categoria
    while ($rowComponente = $resultComponentes->fetch_assoc()) {
        $componenteID = $rowComponente['id'];
        $categorias[$categoriaID]['componentes'][$componenteID] = $rowComponente['nome'];
    }
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Certifique-se de que o array $_POST['produtos'] existe e não é nulo
  if (isset($_POST['produtos']) && is_array($_POST['produtos'])) {
      foreach ($_POST['produtos'] as $produto) {
          $produtoID = mysqli_real_escape_string($conn, $produto);

          // Certifique-se de que $produtoID existe nas categorias
          foreach ($categorias as $categoria) {
              if (isset($categoria['componentes'][$produtoID])) {
                  // Faça o que precisa ser feito com $produtoID
                  echo "Produto selecionado: " . $categoria['componentes'][$produtoID] . "<br>";
                  // Aqui você pode realizar ações adicionais, como inserir no banco de dados
              }
          }
      }
  } else {
      echo "Nenhum produto selecionado.";
  }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>



<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="./imagens/favicon-32x32.png">
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

    h1 {
      color: white;
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      /* Reduzi o padding para compactar a tabela */
      text-align: left;
    }

    th {
      background-color: #162938;
      color: #fff;
    }

    tr {
      background-color: white;
    }

    .search-form {
      margin-bottom: 20px;
      text-align: center;
    }

    .search-form input {
      padding: 10px;
      width: 60%;
      border: 2px solid #162938;
      border-radius: 5px;
      outline: none;
      font-size: 1em;
      color: #162938;
    }

    .search-form button {
      padding: 10px 20px;
      background-color: #162938;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .search-form button:hover {
      background-color: #fff;
      color: #162938;
    }

    .show-description-btn {
      background: none;
      border: none;
      color: #162938;
      cursor: pointer;
      text-decoration: underline;
    }

    .hidden-description {
      display: none;
      color: #162938;
    }
    .checkbox-group {
        margin-bottom: 15px;
        
      }

    .category-label {
        cursor: pointer;
        color: #162938;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .category-checkbox {
        margin-left: 10px;
        display: none;
    }

    .component-checkbox {
        margin-left: 30px;
        
    }
  </style>
  <title>Formulário de Projetos Arduino</title>
  <link rel="icon" href="./imagens/favicon-32x32.png">
</head>

<body>
  <div class="container">
    <div class="modal">
      <div class="modal__header">
        <span class="modal__title">Novo Projeto</span><button class="button button--icon"
          onclick="window.location.href='pagina1.php'">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="none" d="M0 0h24v24H0V0z"></path>
            <path
              d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z">
            </path>
          </svg>
        </button>
      </div>
      <div class="modal__body">
        <form action="adicionar_projeto_comunitario.php" method="POST" enctype="multipart/form-data">
          <!-- Seu formulário aqui... -->
          <p class="input__description"> Nome específico do projeto.</p>
          <label for="nome" class="input__label">Nome do Projeto:</label>
          <br>
          <input type="text" id="nome" name="nome" class="input__field" required><br><br>

          <p class="input__description"> Descrição passo a passo da implementação do projeto e do respetivo codigo.
            </p>
          <label for="descricao" class="input__label">Descrição:</label><br>
          <textarea id="descricao" name="descricao" class="input__field" required></textarea><br><br>

          <p class="input__description">Introduzir uma imagem ilustrativado projeto.</p>
          <label for="imagem" class="input__label">Imagem:</label>
          <br>
          <input type="file" id="imagem" name="imagem" class="input__field" required><br><br>

          <p class="input__description">Itroduzir o codigo fonte do projeto.</p>
          <label for="codigo" class="input__label">Código:</label><br>
          <textarea id="codigo" name="codigo" class="input__field" required></textarea><br><br>

          <p class="input__description">Copiar o codigo embutido da simulação do projeto no Tinkercad. </p>
          <p class="input__description">(Quando o projeto é publico, aceder ao botão partilhar e copie o codigo <\>.)</p>
         
          <label for="simula" class="input__label">Simulação:</label><br>
          <textarea id="simula" name="simula" class="input__field" required></textarea><br><br>

          <p class="input__description">Selecione os componentes nessesarios para a execução do projeto.</p>

          <?php
// Loop para gerar checkboxes para cada categoria e produto
foreach ($categorias as $categoriaID => $categoria) {
    echo '<div class="checkbox-group">';
    echo "<h3 class='category-label'>{$categoria['nome']}</h3>";
    echo '<div class="category-checkbox">';

    // Certifique-se de que a chave 'componentes' existe antes de acessá-la
    if (isset($categoria['componentes']) && is_array($categoria['componentes'])) {
        foreach ($categoria['componentes'] as $componenteID => $componenteNome) {
            echo "<label><input type='checkbox' name='produtos[]' value='$componenteID'> $componenteNome</label><br>";
        }
    } else {
        echo "Nenhum componente nesta categoria.";
    }

    echo '</div>';
    echo '</div>';
}
?>
          <div class="modal__footer">
            <button class="button button--primary" type="submit">Criar Projeto</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  // Verifique se o usuário está autenticado (por exemplo, usando algum outro mecanismo de autenticação)
  if (!isset($_SESSION['id_usuario'])) {
    die("Você não está autenticado.");
  }

  $usuarioLogadoId = $_SESSION['id_usuario'];

  $servername = "localhost";
  $username = "id20757658_miguelgaitas";
  $password = "MiguelGaitas24.";
  $dbname = "id20757658_dados_dos_registros";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  // Adiciona este trecho para filtrar os resultados com base na pesquisa
  $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
  $sql = "SELECT * FROM projetos_arduino WHERE autor = $usuarioLogadoId";

  if (!empty($searchTerm)) {
    $sql .= " AND nome LIKE '%$searchTerm%'";
  }

  $result = $conn->query($sql);
  ?>

  <h1>Projetos Pessoais</h1>
  <form action="" method="GET">
    <input type="text" id="search" name="search" placeholder="Pesquisar por nome do projeto"
      value="<?php echo $searchTerm; ?>">
    <button type="submit">Pesquisar</button>
  </form>
  <table>
    <thead>
      <tr>
        <th>Nome do Projeto</th>

        <th>Imagem</th>
        <th>Código</th>
        <th>Simulação</th>
        <th>Descrição</th>
        <th>Tempo Restante</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
        echo "<tr class='project-row'>";
        echo "<td class='project-cell'>" . $row['nome'] . "</td>";
        echo "<td class='project-cell img-cell'><img src='./imagens/" . $row['imagem'] . "' alt='Imagem do Projeto' style='max-width: 100px;'></td>";
        echo "<td class='project-cell'>" . $row['codigo'] . "</td>";
        echo "<td class='project-cell'>" . $row['simula'] . "</td>";

        $tempoRestante = "";
        $acoes = "";

        if ($row['status'] == 'rejeitado') {
          $prazoEdicao = strtotime($row['prazo_edicao']);
          $tempoRestanteSegundos = $prazoEdicao - time(); // Diferença em segundos
      
          if ($tempoRestanteSegundos > 0) {
            $dias = floor($tempoRestanteSegundos / (60 * 60 * 24));
            $horas = floor(($tempoRestanteSegundos - ($dias * 60 * 60 * 24)) / (60 * 60));
            $minutos = floor(($tempoRestanteSegundos - ($dias * 60 * 60 * 24) - ($horas * 60 * 60)) / 60);
            $segundos = $tempoRestanteSegundos % 60;

            $tempoRestante = "Projeto Rejeitado por não condizer com as normas: $dias dias, $horas horas, $minutos minutos e $segundos segundos para editar o projeto.";
            $acoes = "<a href='editar_projeto_comunitario.php?id=" . $row['id'] . "'>Editar</a>";
          } else {
            $tempoRestante = "Tempo para edição esgotado";
          }
        } else {
          $tempoRestante = "Projeto em estado indefinido";
          $acoes = "<a href='editar_projeto_comunitario.php?id=" . $row['id'] . "'>Editar</a>";
        }

        // Adiciona o botão "Mostrar/Esconder Descrição"
        echo "<td class='project-cell'><button class='show-description-btn' data-project-id='" . $row['id'] . "'>Mostrar/Esconder Descrição</button></td>";

        echo "<td class='project-cell'>$tempoRestante</td>";
        echo "<td class='project-cell'>$acoes</td>";
        echo "</tr>";

        // Adiciona a linha abaixo para exibir a descrição que será oculta inicialmente
        echo "<tr>";
        echo "<td colspan='7' class='hidden-description project-cell' id='description_" . $row['id'] . "'>" . $row['descricao'] . "</td>";
        echo "</tr>";
      }
      ?>


  </table>
  <!-- Adicione este script jQuery e JavaScript no final do seu HTML -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.show-description-btn').click(function () {
        var projectId = $(this).data('project-id');
        var descriptionDiv = $('#description_' + projectId);

        // Alterna a visibilidade da descrição ao clicar no botão
        descriptionDiv.toggle();

        // Atualiza o texto do botão com base na visibilidade da descrição
        var buttonText = descriptionDiv.is(':visible') ? 'Esconder Descrição' : 'Mostrar Descrição';
        $(this).text(buttonText);
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('.category-label').click(function () {
        $(this).next('.category-checkbox').toggle();
      });
    });
  </script>
</body>

</html>