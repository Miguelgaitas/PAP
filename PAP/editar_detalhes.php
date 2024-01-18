<?php
// Início da sessão
session_start();

// Verificação se o usuário está conectado
if (isset($_SESSION['id_usuario'])) {
  // Conecte-se ao banco de dados
  $servername = "localhost";
  $username = "id20757658_miguelgaitas";
  $password = "MiguelGaitas24.";
  $dbname = "id20757658_dados_dos_registros";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
  }

  // Recuperar o ID do usuário da sessão
  $user_id = $_SESSION['id_usuario'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter informações do usuário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $oldpass = md5($_POST['oldpass']);
    $senha = md5($_POST['senha']);

    if (isset($oldpass)) {
      $query = "SELECT senha FROM usuarios where id = $user_id";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldpwd = $row['senha'];

        if ($oldpwd == $oldpass) {
          // Atualizar as informações do usuário
          $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $user_id";

          if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Informações atualizadas com sucesso!'); window.location.href = 'login.php';</script>";
          } else {
            echo "Erro ao atualizar as informações: " . mysqli_error($conn);
          }
        }

      }

    }


  }

  // Consulta para recuperar os detalhes do usuário com base no ID
  $sql = "SELECT nome, email FROM usuarios WHERE id = $user_id";
  $resultado = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultado) == 1) {
    // Exibir o formulário de edição do usuário
    $row = mysqli_fetch_assoc($resultado);
    ?>
    <!DOCTYPE html>
    <html>

    <head>
    <link rel="icon" href="./imagens/favicon-32x32.png">
      <title>Editar Utilizador</title>
      <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins',sans-serif;

  }
  body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg')repeat;
    background-size: cover;
    background-position: center;
  } 
  
  header{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 99;
    
  }
  .logo{
    font-size: 1em;
    color: #fff;
    user-select: none;
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
  .navigation a:hover::after{
    transform-origin: left;
    transform: scaleX(1);
  }
  .navigation .btnlogin-popup{
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
  .navigation .btnlogin-popup:hover{
    background: #fff;
    color:#162938;
  }
  .warpper{
    position:relative;
	width:400px;
	height:440px;
	background:transparent;
	border:2px solid rgba(255,255,255,.5);
	border-radius:20px;
	backdrop-filter:blur(20px);
	box-shadow:0 0 30px rgba(0,0,0, .5);
	display:flex;
	justify-content: center;
	align-items: center;
  overflow: hidden;
  transition: transform .5s ease,heigth .2s ease;
  }
  .warpper.active-popup{
    transform: scale(1);
  }
  .warpper .form-box{
    width: 100%;
    padding: 40px;
  }
  .warpper .icon-close{
    position: absolute;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    background: #162938;
    font-size: 2em;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items:center ;
    border-bottom-left-radius: 20px;
    cursor: pointer;
    z-index: 1;
  }
  .form-box{
    font-size: 1.1em;
    color: #fff;
    text-align: center;
    margin-top: 20px;
  }
  .form-box h2{ 
    font-size: 2em;
    color: #fff;
    text-align: center;
  }

    .input-box{
    position: relative;
    width: 100%;
    height: 50px;
    border-bottom: 2px solid #fff;
    margin: 20px 0;
    size: 40px;

  }
  .input-box label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    font-size: 1em;
    color: #fff;
    font-weight: 500;
    pointer-events: none;
    transition: .5s;

  }
  .input-box input:focus~label,
  .input-box input:valid~label{
    top: -5px;
    
  }
  
  
  .input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    color: #fff;
    font-weight: 600;
    padding: 0 35px 0 5 px;
  }
  .input-box .icon{
    position: absolute;
    right: 8px;
    font-size: 1.2em;
    color: #fff;
    line-height: 57px;
  }
  .remenber-forgot{
    font-size: .9em;
    color: #fff;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
  }
  .remenber-forgot label input{
    accent-color: #fff;
    margin-right: 3px;
  }
  .remenber-forgot a {
    color: #fff;
    text-decoration: none;
  }
  .remenber-forgot a:hover{
    text-decoration: underline;
  }
  .btn{
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    font-size:1em;
    color: #162938;
    font-weight: 500;


  }
  .login-register{
    font-size: .9em;
    color: #fff;
    text-align: center;
    font-weight: 500;
    margin: 25px 0 10px;
  }
  .login-register p a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;

  }

  .login-register p a:hover {
    text-decoration: underline;
  }
  .popup-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
}

.popup-content h3 {
  margin-top: 0;
}

.popup-content p {
  margin-bottom: 10px;
}

.popup-content button {
  padding: 10px 20px;
  background-color: #337ab7;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.popup-content button:hover {
  background-color: #286090;
}

      </style>
    </head>

    <body>
      <header>
        <h2 class="logo">
          <img src="./imagens/Capturar-removebg-preview.png" alt="Logo" class="logo-image"
            style="width: 148px; height: auto;">
        </h2>
        <nav class="navigation">
        <button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Cancelar</button>
        </nav>
      </header>
      <div class="warpper">
        <div class="form-box login">
          <h2>Editar Utilizador</h2>
          <form method="POST" action="">
            <div class="input-box">
              <span class="icon"><ion-icon name="person-outline"></ion-icon></span>

              <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>
              <label>Nome:</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>

              <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
              <label>Email:</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>

              <input type="password" name="oldpass" required>
              <label>Senha antiga:</label>
            </div>
            <div class="input-box">
              <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>

              <input type="password" name="senha" required>
              <label>Nova senha:</label>
            </div>

            <button type="submit" value="atualizar" class="btn">Atualizar</button>

          </form>
        </div>
      </div>
      <script src="script.js"></script>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>

    </html>
    <?php
  } else {
    echo "Nenhum usuário encontrado com o ID fornecido.";
  }
  mysqli_close($conn);
} else {
  echo "Usuário não está conectado.";
}
?>