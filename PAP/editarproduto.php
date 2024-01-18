<?php


include("./verificaradm.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
	<title>Editar Produto</title>
	<style>
	body {
    font-family: 'Poppins', sans-serif;
    background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg') repeat;
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    display: flex;
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

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.btn {
    display: block;
    margin-bottom: 20px;
    text-align: center;
    text-decoration: none;
    padding: 10px 20px;
    background-color: #162938;
    color: #fff;
    border-radius: 5px;
}

form {
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-top: 10px;
}

form input,
form textarea {
    width: 97%;
    padding: 10px;
    margin-bottom: 10px;
    border: 2px solid #162938;
    border-radius: 5px;
    outline: none;
    font-size: 1em;
    color: #162938;
}

form input[type="number"] {
    width: calc(100% - 22px); /* Ajuste para a largura do campo de número */
}

form input[type="submit"] {
    background-color: #162938;
    color: #fff;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #fff;
    color: #162938;
}
</style>
</head>
<body>
	<?php
		// Conexão com a base de dados
		$servername = "localhost";
		$username = "id20757658_miguelgaitas";
		$password = "MiguelGaitas24.";
		$dbname = "id20757658_dados_dos_registros";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
		    die("Conexão falhou: " . mysqli_connect_error());
		}

		// Verifica se o formulário de edição foi enviado e processa as informações
		if (isset($_POST['enviar'])) {
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$preco = $_POST['preco'];
			$quantidade = $_POST['quantidade_em_stock'];
			$link = $_POST['link'];

			// Atualiza as informações do produto na base de dados
			$sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco=$preco, quantidade_em_stock=$quantidade, link='$link' WHERE id=$id";

			if (mysqli_query($conn, $sql)) {
			    echo "Produto atualizado com sucesso!";
			} else {
			    echo "Erro ao atualizar produto: " . mysqli_error($conn);
			}
		}

		// Seleciona as informações do produto com base no ID enviado via GET
		$id = $_GET['id'];
		$sql = "SELECT * FROM produtos WHERE id=$id";
		$resultado = mysqli_query($conn, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$linha = mysqli_fetch_assoc($resultado);
		} else {
			echo "Produto não encontrado";
			exit;
		}

		mysqli_close($conn);
	?>

	<div class="container">
		<h1>Editar Produto</h1>
        <a href="produtos.php" class="btn">Voltar</a>


		<form method="post">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="<?php echo $linha['nome']; ?>">

			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao"><?php echo $linha['descricao']; ?></textarea>

			<label for="preco">Preço:</label>
			<input type="number" id="preco" name="preco" step="0.01" value="<?php echo $linha['preco']; ?>">

			<label for="quantidade_em_stock">Quantidade em stock:</label>
			<input type="number" id="quantidade_em_stock" name="quantidade_em_stock" value="<?php echo $linha['quantidade_em_stock']; ?>">

			<label for="link">Link:</label>
			<input type="text" id="link" name="link" value="<?php echo $linha['link']; ?>">


			<input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
			<input type="submit" name="enviar" value="Salvar">
		</form>
	</div>
</body>
</html>
