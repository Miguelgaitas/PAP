<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
	<title>Lojas</title>
	<style>
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
			top: 20px;
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

th, td {
  text-align: center; 
    color: white;
    backdrop-filter: blur(5px); /* Aplica o efeito de desfoque (blur) */
    background-color: rgba(0, 0, 0, 0.4); /* Define a cor de fundo com transparência */
    border: 2px solid white; /* Adiciona a borda branca de 2px */
}

th {
 text-align: center;  
  color: white;
    backdrop-filter: blur(5px); /* Aplica o efeito de desfoque (blur) */
    background-color: rgba(0, 0, 0, 0.4); /* Define a cor de fundo com transparência */
    border: 2px solid white; /* Adiciona a borda branca de 2px */
}


		.button {
			background-color: #4CAF50;
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
	</style>

	<script>
// Quando o usuário rolar 20px para baixo da parte superior da página, mostra o botão
window.onscroll = function() {scrollFunction()};

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
			<a href="primeira_pagina.php">Pagína Inicial</a>
			<a href="pagina1.php">Projetos</a>
			<a href="pagina2.php">Top 5</a>
			<a href="perguntas_e_respostas.php">Forum</a>
			<a href="contact.php">Contacto</a>
			<button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
			</a>
		</nav>
	</header>

	<main>
<br><br><br><br>
<!-- Tabela de lojas e produtos -->
<table>
	<thead>
		<tr>
			<th>   Nome da loja</th>
			<th>  Endereço</th>
			<th>  Cidade </th>
			<th>  Código postal </th>
			<th>  Telefone  </th>
			<th>Produtos disponíveis  </th>
		</tr>
	</thead>
	<tbody>
	<?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Selecionar todas as lojas
$query_lojas = "SELECT * FROM lojas";
$resultado_lojas = mysqli_query($conexao, $query_lojas);

// Loop através das lojas
while ($loja = mysqli_fetch_assoc($resultado_lojas)) {
    echo '<tr>';
    echo '<td>' . $loja['nome'] . '</td>';
    echo '<td>' . $loja['endereco'] . '</td>';
    echo '<td>' . $loja['cidade'] . '</td>';
    echo '<td>' . $loja['codigo_postal'] . '</td>';
    echo '<td>' . $loja['telefone'] . '</td>';

    // Selecionar os componentes disponíveis na loja atual
    $query_componentes_loja = "SELECT componente_id FROM loja_componente WHERE loja_id = " . $loja['id'];
    $resultado_componentes_loja = mysqli_query($conexao, $query_componentes_loja);

    // Loop através dos componentes disponíveis na loja atual
    $componentes = array();
    while ($componente_loja = mysqli_fetch_assoc($resultado_componentes_loja)) {
        $query_componente = "SELECT * FROM componentes WHERE id = " . $componente_loja['componente_id'];
        $resultado_componente = mysqli_query($conexao, $query_componente);
        $componente = mysqli_fetch_assoc($resultado_componente);
        $componentes[] = $componente['nome'];
    }

    echo '<td>' . implode(', ', $componentes) . '</td>';
    echo '</tr>';
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
	</tbody>
</table>
</body>
</html>
		<button id="voltar-ao-topo" onclick="topFunction()">Voltar ao topo</button>
	</main>

</body>
</html>
