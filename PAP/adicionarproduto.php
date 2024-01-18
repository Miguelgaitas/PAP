<?php


include("./verificaradm.php");

?>
<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Conexão com a base de dados
	$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
	    die("Conexão falhou: " . mysqli_connect_error());
	}

	// Insere um novo produto na base de dados
	$sql = "INSERT INTO produtos (nome, descricao, preco, quantidade_em_stock, link) VALUES ('" . $_POST['nome'] . "', '" . $_POST['descricao'] . "', '" . $_POST['preco'] . "', '" . $_POST['quantidade'] . "', '" . $_POST['link'] . "')";
	if (mysqli_query($conn, $sql)) {
	    echo "<p>Produto adicionado com sucesso!</p>";
	} else {
	    echo "Erro ao adicionar o produto: " . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>
<button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="history.back()">Voltar</button>
