<?php


include("./verificaradm.php");

?>
<!DOCTYPE html>
<html lang="pt">

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
	<meta charset="UTF-8">
	<title>Dashboard</title>
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
    margin: 30px 0;
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
    width: 85%;
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
        style="width: 120px; height: auto;">
    </h2>
    <nav class="navigation">
      <button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
      </a>

    </nav>
	</header>
	<div class="container">
	<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

// Crie uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter o número total de usuários
$sqlUsuarios = "SELECT COUNT(*) AS totalUsuarios FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuarios);

if ($resultUsuarios->num_rows > 0) {
    $rowUsuarios = $resultUsuarios->fetch_assoc();
    $totalUsuarios = $rowUsuarios["totalUsuarios"];
} else {
    $totalUsuarios = 0;
}

// Consulta para obter o número total de projetos
$sqlProjetos = "SELECT COUNT(*) AS totalProjetos FROM projetos_arduino";
$resultProjetos = $conn->query($sqlProjetos);

if ($resultProjetos->num_rows > 0) {
    $rowProjetos = $resultProjetos->fetch_assoc();
    $totalProjetos = $rowProjetos["totalProjetos"];
} else {
    $totalProjetos = 0;
}

$conn->close();
?>


<div class='warpper'>
		<section>
			<div class="form-box login">
				<h3>Utilizadores no Site</h3>
				<p>
					<?php echo $totalUsuarios; ?>
				</p>
			</div>
			<div class="form-box login">
				<h3>Total de Projetos</h3>
				<p>
					<?php echo $totalProjetos; ?>
				</p>
			</div>
		</section>

		<div class="button-container">
		<button onclick="window.location.href='adminusuarios.php'" class="btn">Utilizadores</button><br><br>
<button onclick="window.location.href='adicionar_componente.php'" class="btn">Componentes</button><br><br>
<button onclick="window.location.href='addlojas.php'" class="btn">Lojas</button><br><br>
<button onclick="window.location.href='addprojetosarduino.php'" class="btn">Projetos Arduino</button><br><br>
<button onclick="window.location.href='projetos_pendentes.php'" class="btn">Verificar Projetos</button><br><br>

		</div>
	</div>
</div>
</body>

</html>