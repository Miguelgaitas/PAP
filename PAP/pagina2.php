<?php
$host = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

// Cria uma conexão com o banco de dados
$conn = mysqli_connect($host, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
	die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="icon" href="./imagens/favicon-32x32.png">
	<title>Componentes</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

		body {
			background-image: url(https://voenews.com.br/wp-content/uploads/2019/08/Berlengas-Island-_Centrode-Portugal.jpg);
			background-repeat: repeat;
			background-size: cover;
			margin: 0;
			padding: 0;
			font-family: 'Poppins', sans-serif;
		}

		.wrapper {
			margin: 0;
			padding: 0;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			width: 100vw;
			min-height: 100vh;
			background-color: rgba(0, 0, 0, 0.5);
		}

		.projeto {
			display: flex;
			flex-direction: column;
			border: 1px solid black;
			border-radius: 15px;
			overflow: hidden;
			justify-content: center;
			align-items: center;
			text-align: center;
			padding: 15px;
			margin: 10px;
			width: 400px;
			height: 500px;
			background-color: rgba(0, 0, 0, 0.01);
			backdrop-filter: blur(6px);
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

		.projeto * {
			text-decoration: none;
			color: white;
		}

		.add-button {
			text-align: center;
			margin-bottom: 20px;
		}

		.projeto a {
			border-radius: 5px;
			width: 150px;
			height: 25px;
			margin-bottom: 10px;
			text-decoration: none;
			color: white;
			background-color: rgba(255, 255, 255, 0.25);
		}

		/* Estilo do corpo da página */


		/* Estilo do cabeçalho */
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'poppins', sans-serif;

		}

		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg')repeat;
			background-size: cover;
			background-position: center;
		}

		.warpper {
			position: relative;
			width: 400px;
			height: 440px;
			background: transparent;
			border: 2px solid rgba(255, 255, 255, .5);
			border-radius: 20px;
			backdrop-filter: blur(20px);
			box-shadow: 0 0 30px rgba(0, 0, 0, .5);
			display: flex;
			justify-content: center;
			align-items: center;
			overflow: hidden;
			transition: transform .5s ease, heigth .2s ease;
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
			margin-left: 20px;
			transition: .5s;
		}

		.navigation .btnlogin-popup:hover {
			background: #fff;
			color: #162938;
		}

		.container {
			position: absolute;
			top: 170px;
			margin-top: 0px;
		}

		h1 {
			font-size: 48px;
			margin-top: 0px;
			text-align: center;
			color: white;
			text-shadow: 1px 1px #fff;
		}

		p {
			font-size: 20px;
			margin-top: 32px;
			text-align: center;
			color: white;
			text-shadow: 1px 1px #fff;
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

		table {
			border-collapse: collapse;
			width: 100%;
			position: relative;

		}

		table:before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: -1;
		}

		th,
		td {
			text-align: center;
			color: white;
			backdrop-filter: blur(5px);
			/* Aplica o efeito de desfoque (blur) */
			background-color: rgba(0, 0, 0, 0.4);
			/* Define a cor de fundo com transparência */
			border: 2px solid white;
			/* Adiciona a borda branca de 2px */
		}

		th {
			text-align: center;
			color: white;
			backdrop-filter: blur(5px);
			/* Aplica o efeito de desfoque (blur) */
			background-color: rgba(0, 0, 0, 0.4);
			/* Define a cor de fundo com transparência */
			border: 2px solid white;
			/* Adiciona a borda branca de 2px */
		}


		.button {
			background-color: red;
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			position: absolute;
			top: 20px;
			right: 20px;
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

		/* Estilos para a barra de pesquisa */
		#query {
			padding: 10px;
			width: 300px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-right: 10px;
		}

		#searchButton {
			padding: 10px 15px;
			background-color: red;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		/* Estilos para os resultados da pesquisa */
		#searchResults {
			margin-top: 20px;
		}

		#searchResults h3 {
			font-size: 18px;
			margin-bottom: 5px;
		}

		#searchResults p {
			margin: 5px 0;
		}

		/* Estilos para o botão "Atualizar Produtos" */
		#atualizarProdutosButton {
			display: inline-block;
			padding: 10px 20px;
			background-color: red;
			/* Cor de fundo */
			color: #fff;
			/* Cor do texto */
			border: none;
			border-radius: 5px;
			font-size: 16px;
			text-decoration: none;
			cursor: pointer;
			transition: background-color 0.3s;
			float: right;
		}

		#atualizarProdutosButton:hover {
			background-color: red;
			/* Cor de fundo ao passar o mouse */
		}
		

		/* Adicione mais estilos conforme necessário */
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
			<a href="primeira_pagina.php">Pagina Inicial</a>
			<a href="pagina1.php">Projetos</a>
			<a href="pagina3.php">Lojas</a>
			<a href="perguntas_e_respostas.php">Forum</a>
			<a href="contact.php">Contacto</a>
			<button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
			</a>
		</nav>
	</header>


	<div class="container">
		<a href="update.php">
		</a>
<h1></h1>


		<table id="searchResults">
			<!-- Conteúdo da tabela de resultados -->
		</table>


		<script>
			$(document).ready(function () {
				$("#searchButton").click(function () {
					var query = $("#query").val();

					$.ajax({
						type: "POST",
						url: "search.php",
						data: { query: query },
						success: function (result) {
							$("#searchResults").html(result);
						}
					});
				});
			});
		</script>

<?php
        // Substitua as configurações do banco de dados conforme necessário
        $servername = "localhost";
        $username = "id20757658_miguelgaitas";
        $password = "MiguelGaitas24.";
        $dbname = "id20757658_dados_dos_registros";

        // Conectar ao banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar a conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }
// Consulta para obter os top usuários que mais contribuíram com projetos verificados (excluindo usuário com ID 1)
$sqlContribuidores = "SELECT autor, COUNT(*) as total_projetos FROM projetos_arduino WHERE autor <> 1 AND status = 'verificado' GROUP BY autor ORDER BY total_projetos DESC LIMIT 5";
$resultContribuidores = $conn->query($sqlContribuidores);

// Exibir os resultados em uma tabela HTML
if ($resultContribuidores->num_rows > 0) {
    echo "<h1>Top 5 Contribuidores</h1>";
    echo "<table>";
    echo "<tr><th>Nome do Utilizador</th><th>Total de Projetos Verificados</th></tr>";
    while ($row = $resultContribuidores->fetch_assoc()) {
        $autorId = $row["autor"];
        $nomeUsuario = getNomeUsuario($autorId, $conn);
        echo "<tr><td>" . $nomeUsuario . "</td><td>" . $row["total_projetos"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Não foram encontrados contribuidores verificados.";
}

// Função para obter o nome do usuário pelo ID
function getNomeUsuario($autorId, $conn) {
    $sql = "SELECT nome FROM usuarios WHERE id = $autorId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["nome"];
    } else {
        return "Desconhecido";
    }
}

        // Consulta para obter os top 5 componentes mais utilizados
        $sqlComponentes = "SELECT * FROM componentes ORDER BY quantidade_utilizada DESC LIMIT 5";
        $resultComponentes = $conn->query($sqlComponentes);

        // Exibir os resultados em uma tabela HTML
        if ($resultComponentes->num_rows > 0) {
            echo "<h1>Top 5 Componentes Mais Utilizados</h1>";
            echo "<table>";
            echo "<tr><th>Nome</th><th>Quantidade Utilizada</th></tr>";
            while ($row = $resultComponentes->fetch_assoc()) {
                echo "<tr><td>" . $row["nome"] . "</td><td>" . $row["quantidade_utilizada"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Não foram encontrados componentes.";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
        ?>

	</div>
	<button id="voltar-ao-topo" onclick="topFunction()">Voltar ao topo</button>
	</main>

</body>

</html>