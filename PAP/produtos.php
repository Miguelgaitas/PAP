<?php


include("./verificaradm.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
	<title>Gerenciamento de Produtos</title>
	<style>
	body {
    font-family: 'poppins', sans-serif;
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
	width: 95%;
    display: block;
    margin-bottom: 20px;
    text-align: center;
    text-decoration: none;
    padding: 10px 20px;
    background-color: #162938;
    color: #fff;
    border-radius: 5px;
}

.btn:hover {
    background-color: #fff;
    color: #162938;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #162938;
    color: #fff;
}

tr:hover {
    background-color: #f5f5f5;
}

/* Estilos para o formulário de pesquisa */
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
form {
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-top: 10px;
}

form input,
form textarea {
    width: 95%;
    padding: 10px;
    margin-bottom: 10px;
    border: 2px solid #162938;
    border-radius: 5px;
    outline: none;
    font-size: 1em;
    color: #162938;
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
	<div class="container">
		<h1>Gestão de Produtos</h1>
		<a href="pagina_de_admin.php" class="btn">Voltar</a>

		<h2>Adicionar Produto</h2>
		<form method="post" action="adicionarproduto.php">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required>

			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao" required></textarea>

			<label for="preco">Preço:</label>
			<input type="number" id="preco" name="preco" min="0" step="0.01" required>

			<label for="quantidade">Quantidade em Stock:</label>
			<input type="number" id="quantidade" name="quantidade" min="0" required>
			<label for="link">Link:</label>
<input type="text" id="link" name="link">


			<input type="submit" value="Adicionar" class="btn">
            
		</form>

		<hr>

		<h2>Produtos Existentes</h2>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Preço</th>
					<th>Quantidade em Stock</th>
					<th>Link para o produto</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
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

        // Seleciona todos os produtos da base de dados
        $sql = "SELECT * FROM produtos";
        $resultado = mysqli_query($conn, $sql);

        // Loop através de todos os produtos e exibe suas informações em uma tabela
        while ($linha = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $linha['id'] . "</td>";
            echo "<td>" . $linha['nome'] . "</td>";
            echo "<td>" . $linha['descricao'] . "</td>";
            echo "<td>€" . number_format($linha['preco'], 2, ',', '.') . "</td>";
            echo "<td>" . $linha['quantidade_em_stock'] . "</td>";
            echo "<td><a href='" . $linha['link'] . "'>Link para o Produto</a></td>";
            echo "<td>";
            echo "<a href='editarproduto.php?id=" . $linha['id'] . "'>Editar</a> | ";
            echo "<a href='excluirproduto.php?id=" . $linha['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }

        mysqli_close($conn);
    ?>
			</tbody>
		</table>
	</div>
</body>
</html>
