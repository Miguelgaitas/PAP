<?php
session_start();

$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

function getProjetos($conn)
{
  $meuID = $_SESSION['id_usuario'];
  $search = ''; // Inicialize a variável de pesquisa
  $filtro = ''; // Inicialize o filtro

  if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
  }

  if (isset($_POST['filtro'])) {
    $filtro = $_POST['filtro'];
  }

  $sql = "SELECT p.id, p.nome, p.descricao, p.status, p.imagem, p.codigo, u.nome AS nome_utilizador
  FROM projetos_arduino p
  LEFT JOIN usuarios u ON p.autor = u.id
  WHERE ";

  if ($filtro === 'verificado') {
    $sql .= "p.status = 'verificado'";
  } elseif ($filtro === 'pendente') {
    $sql .= "p.status != 'verificado' AND (p.status != 'rejeitado' OR p.prazo_edicao >= NOW()) AND p.autor = $meuID";
  } elseif ($filtro === 'expirado') {
    $sql .= "p.prazo_edicao < NOW()"; // Ajuste para a data de expiração
  } else {
    $sql .= "p.status = 'verificado'";
  }

  $sql .= " AND (p.nome LIKE '%$search%' OR p.descricao LIKE '%$search%')
  ORDER BY p.id";

  $result = mysqli_query($conn, $sql);

  if (!$result || mysqli_num_rows($result) == 0) {
    echo "Nenhum projeto encontrado.";
    return;
  }

  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $nome = $row["nome"];
    $desc = $row["descricao"];
    $status = $row["status"];
    $img = $row["imagem"];
    $cod = $row["codigo"];
    $nomeUtilizador = $row["nome_utilizador"];

    echo "<div class='projeto'>
            <h1>$nome</h1>
            <img src='./imagens/$img'>
            <br>
            <h3><p class=$status>Status: " . ucfirst($status) . "</p></h3>
            <p>Criado por: $nomeUtilizador</p>
            <br>
            <center>
              <a class='texto' href='projeto.php?id=$id'>Ver Mais</a>
            </center>
          </div>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="./imagens/favicon-32x32.png">
  <title>Projeto Adrduino </title>
  <style>
    /* Estilo do cabeçalho */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'poppins', sans-serif;

    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 150px;
      padding: 20px 100px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 99;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, .5);
      border-radius: 6px;
    }

    /* Estilo do título do cabeçalho */
    header h1 {
      margin: 0;
    }

    .navigation a {
      position: relative;
      font-size: 1.1em;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      margin-left: 40px;
    }

    .navigation a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -6px;
      width: 100%;
      height: 3px;
      background: #fff;
      border-radius: 5px;
      transform-origin: right;
      transform: scaleX(0);
      transition: transform .5s;
    }

    .navigation a:hover::after {
      transform-origin: left;
      transform: scaleX(1);
    }

    .conteiner {
      width: 100%;
      max-width: 500px;
      backdrop-filter: blur(10px);
    }

    .logo {
      font-size: 2em;
      color: #fff;
      user-select: none;
    }

    .navigation .btnlogin-popup {
      width: 130px;
      height: 50px;
      background: transparent;
      border: 2px solid #fff;
      outline: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1.1em;
      color: #fff;
      font-weight: 500;
      margin-left: 40px;
      transition: .5s;
    }

    .navigation .btnlogin-popup:hover {
      background: #fff;
      color: #162938;
    }



    #voltar-ao-topo {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: #fff;
      color: #444;
      cursor: pointer;
      padding: 15px;
      border-radius: 10px;
      transition: background-color 0.3s;
    }

    #voltar-ao-topo:hover {
      color: #fff;
      background-color: #444;
    }

    .verificado {
      color: green;
    }

    .rejeitado {
      color: red;
    }

    .pendente {
      color: yellow;
    }

    /* Mostra o botão quando o usuário rolar 20px para baixo da parte superior da página */
    @media screen and (min-height: 600px) {
      #voltar-ao-topo.show {
        display: block;
      }
    }

    .round-button {
      display: inline-block;
      background-color: grey;
      color: white;
      border-radius: 50%;
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
    }

    .round-button:hover {
      background-color: #45a049;
    }
  </style>
  <script>
    // Quando o usuário rolar 20px para baixo da parte superior da página, mostra o botão
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("voltar-ao-topo").classList.add("show");
      } else {
        document.getElementById("voltar-ao-topo").classList.remove("show");
      }
    }

    // Quando o usuário clicar no botão, volta para o topo da página
    function topFunction() {
      document.body.scrollTop = 0; // Para Safari
      document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE e Opera
    }
  </script>

</head>

<body>

  <header>

    <h2 class="logo">
      <img src="./imagens/Capturar-removebg-preview.png" alt="Logo" class="logo-image"
        style="width: 148px; height: auto;">
    </h2>
    <nav class="navigation">
      <a href="primeira_pagina.php">Pagina inicial</a>
      <a href="addprojetoscomunitarios.php">Propor projeto</a>
      <a href="contact.php">Contacto</a>
      <button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
      </a>

    </nav>
  </header>

  <main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

      body {
        background-image: url(https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg);
        background-repeat: repeat;
        background-size: cover;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
      }

      .wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        min-width: 96vw;
        min-height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
      }

      .projeto:first-child,
      .projeto:nth-child(2),
      .projeto:nth-child(3) {
        margin-top: 180px;
      }

      .projeto {
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255, 255, 255, 0.75);
        border-radius: 15px;
        overflow: hidden;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 15px;
        margin: 10px;
        
        max-width: 380px;
        height: 500px;
        background-color: rgba(0, 0, 0, 0.01);
        backdrop-filter: blur(6px);
        color: white;
      }

      .projeto h1 {
        margin-top: 10px;
      }

      .projeto img {
        width: 380px;
        height: 320px;
        margin-left: 10px;
        margin-right: 10px;
        background-color: lightblue;
        text-align: center;
        line-height: 200px;
        font-size: 36px;
        color: white;
        border-radius: 5px;
      }

      .add-button {
        text-align: center;
        margin-bottom: 20px;
      }

      .texto {
        border-radius: 5px;

        padding: 10px;
        height: 25px;
        margin-bottom: 10px;
        text-decoration: none;
        color: white;
        background-color: rgba(255, 255, 255, 0.25);
      }

      .formT {
        position: absolute;
        margin-top: 160px;
        margin-left: 10px;
      }

      select {
  background-color: red;
  color: white; /* Cor do texto em branco para contraste */
  border: none;
  border-radius: 5px;
  padding: 5px;
  font-size: 16px;
}

/* Estilo para as opções dentro do select */
 select option {
  background-color: red;
  color: white;
}

/* Estilo para a seta do select (seta suspensa) */
 select::-ms-expand {
  display: none; /* Remove a seta no Internet Explorer */
}

select::-webkit-select-placeholder {
  color: white; /* Cor do texto em branco para o placeholder */
}


      .input-container {
        position: absolute;
        display: flex;
        align-items: center;
      }

      .input {
        width: 40px;
        height: 40px;
        border-radius: 20px;
        border: none;
        outline: none;
        padding: 20px 25px;
        background-color: transparent;
        cursor: pointer;
        transition: all .5s ease-in-out;
      }

      .input::placeholder {
        color: transparent;
      }

      .input:focus::placeholder {
        color: rgb(131, 128, 128);
      }

      .input:focus,
      .input:not(:placeholder-shown) {
        background-color: #fff;
        border: 1px solid rgb(91, 107, 255);
        width: 290px;
        cursor: none;
        padding: 18px 16px 18px 45px;
      }

      .icon {
        position: absolute;
        left: 0;
        height: 45px;
        width: 45px;
        background-color: #fff;
        border-radius: 99px;
        z-index: -1;
        fill: rgb(91, 107, 255);
        border: 1px solid rgb(91, 107, 255);
      }

      .input:focus+.icon,
      .input:not(:placeholder-shown)+.icon {
        z-index: 0;
        background-color: transparent;
        border: none;
      }

    </style>
    </head>

    <body>

      <form method="post" class="formT">
        <div class="input-container">
          <input type="text" name="search" class="input" placeholder="Pesquisar projetos">
          <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" class="icon">
            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
            <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
            <g id="SVGRepo_iconCarrier">
              <rect fill="white" height="24" width="24"></rect>
              <path fill=""
                d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z"
                clip-rule="evenodd" fill-rule="evenodd"></path>
            </g>
          </svg>

          <select name="filtro" id="filtro">
    <option value="verificado" <?php if (isset($_POST['filtro']) && $_POST['filtro'] === 'verificado') echo 'selected'; ?>>Verificados</option>
    <option value="pendente" <?php if (isset($_POST['filtro']) && $_POST['filtro'] === 'pendente') echo 'selected'; ?>>Pendentes</option>
    <option value="expirado" <?php if (isset($_POST['filtro']) && $_POST['filtro'] === 'expirado') echo 'selected'; ?>>Expirados</option>
</select>
        </div>
      </form>



      <br>
      <div class="wrapper">
        <?php
        getProjetos($conn);
        ?>
      </div>
      <button id="voltar-ao-topo" onclick="topFunction()">Voltar ao topo</button>
  </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Obtém o valor do filtro do PHP
        var filtroPHP = "<?php echo isset($_POST['filtro']) ? $_POST['filtro'] : ''; ?>";

        // Define automaticamente a opção com base no valor do filtro
        if (filtroPHP !== '') {
            $("#filtro").val(filtroPHP);
        }

        // Adiciona um ouvinte de mudança para enviar o formulário quando o filtro é alterado
        $("#filtro").change(function () {
            // Adicione mais ações se necessário
            $(this).closest("form").submit();
        });
    });
</script>
</html>