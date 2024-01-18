<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
	<title>Minha Página Inicial</title>
	<script>
		// Função para exibir a mensagem de login bem-sucedido em um pop-up
		function exibirMensagem() {
			var mensagem = "<?php echo isset($_GET['mensagem']) ? $_GET['mensagem'] : ''; ?>";
			if (mensagem) {
				var popup = document.createElement('div');
				popup.style.position = 'fixed';
				popup.style.top = '50%';
				popup.style.left = '50%';
				popup.style.transform = 'translate(-50%, -50%)';
				popup.style.padding = '20px';
				popup.style.background = 'lightgray';
				popup.style.border = '1px solid gray';
				popup.style.borderRadius = '5px';
				popup.innerHTML = mensagem;

				document.body.appendChild(popup);

				setTimeout(function () {
					popup.parentNode.removeChild(popup);
				}, 800); // Remover o pop-up após 5 segundos (5000 milissegundos)
			}
		}
		window.onload = exibirMensagem;
	</script>
	<style>
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
			height: 160vh;
			background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg');
			background-repeat: no-repeat;
			background-size: cover;
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
			padding: 10px;
			color: white;
			text-shadow: 1px 1px #fff;
			justify-content: left;
			max-width: 900px;
			margin: auto;
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
			<a href="pagina1.php">Projetos</a>
			<a href="pagina2.php">Top 5</a>
			<a href="pagina3.php">Lojas</a>
			<a href="perguntas_e_respostas.php">Forum</a>
			<a href="contact.php">Contacto</a>
			<button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
			</a>
		</nav>
	</header>
		<div class="container">
			<h1>Arduino: Uma plataforma versátil para projetos eletrónicos interativos</h1><br><br>
			<p>

				O Arduino é uma plataforma de prototipagem eletrônica de código aberto que permite programar
				microcontroladores para controlar dispositivos eletrônicos.</p>
				<p> Com ampla utilização em áreas como eletrônica,
				engenharia, design e arte, o Arduino oferece uma plataforma acessível e de baixo custo para criar projetos
				eletrônicos interativos.</p>
				
				<p>É possível desenvolver desde projetos simples, como acender um LED, até projetos
				mais complexos, como robôs e sistemas de automação residencial.</p>
				
				<p>O Arduino possui uma comunidade ativa de
				usuários que compartilham projetos, bibliotecas de código e recursos online para facilitar o aprendizado e o
				desenvolvimento de habilidades.</p>
				<p> É uma excelente opção para quem deseja iniciar no mundo da eletrônica e
				programação, possibilitando a criação de projetos personalizados e a exploração de novas ideias.
			</p>
		</div>
		


	<button id="voltar-ao-topo" onclick="topFunction()">Voltar ao topo</button>

</body>

</html>