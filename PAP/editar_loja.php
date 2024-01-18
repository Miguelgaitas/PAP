<?php


include("./verificaradm.php");

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

    h1 {
        text-align: center;
        margin-bottom: 20px;
       
    }

    form {
        width: 80%;
        max-width: 600px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        margin-top: 20px;
    }

    label {
        display: block;
        margin-top: 10px;
        color: #162938;
    }

    input[type="text"] {
        width: 95%;
        padding: 10px;
        margin-bottom: 10px;
        border: 2px solid #162938;
        border-radius: 5px;
        outline: none;
        font-size: 1em;
        color: #162938;
    }

    input[type="checkbox"] {
        margin-right: 8px;
    }

    input[type="submit"] {
        background-color: #162938;
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #fff;
        color: #162938;
    }

    .btn-voltar {
      background-color: #162938;
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
}

.btn-voltar:hover {
  background-color: #fff;
        color: #162938;
}

</style>

	<title>Editar loja</title>
</head>
<body>

	<?php
		// Verificar se o ID da loja foi enviado através da URL
		if (isset($_GET['id'])) {
			// Conectar ao banco de dados
			$conexao = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

			// Selecionar a loja com base no ID
			$query = "SELECT * FROM lojas WHERE id = " . $_GET['id'];
			$resultado = mysqli_query($conexao, $query);

			// Verificar se a loja foi encontrada
			if (mysqli_num_rows($resultado) == 1) {
				// Exibir o formulário de edição da loja
				$loja = mysqli_fetch_assoc($resultado);
				echo '<form method="POST" action="salvar_loja.php">';
        echo'<h1>Editar loja</h1>';
				echo '<input type="hidden" name="id" value="' . $loja['id'] . '">';
				echo '<label>Nome:</label>';
				echo '<input type="text" name="nome" value="' . $loja['nome'] . '"><br>';
				echo '<label>Morada:</label>';
				echo '<input type="text" name="endereco" value="' . $loja['endereco'] . '"><br>';
				echo '<label>Cidade:</label>';
				echo '<input type="text" name="cidade" value="' . $loja['cidade'] . '"><br>';
				echo '<label>Código postal:</label>';
				echo '<input type="text" name="codigo_postal" value="' . $loja['codigo_postal'] . '"><br>';
				echo '<label>Telefone:</label>';
				echo '<input type="text" name="telefone" value="' . $loja['telefone'] . '"><br>';
				
				echo '<input type="submit" value="Salvar">';
        echo '<br>';
        echo '<br>';
        echo'<a href="addlojas.php" class="btn btn-voltar">Voltar para Adicionar Loja</a>';
echo '</form>';
} else {
// Exibir mensagem de erro se a loja não foi encontrada
echo '<p>Loja não encontrada.</p>';
}
} else {
// Exibir mensagem de erro se o ID da loja não foi enviado através da URL
echo '<p>ID da loja não especificado.</p>';
}
?>



</body>
</html>