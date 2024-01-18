<?php


include("./verificaradm.php");

?>
<?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Obter os dados do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$codigo_postal = $_POST['codigo_postal'];
$telefone = $_POST['telefone'];
$produtos = $_POST['produtos'];

// Inserir a nova loja na tabela "lojas"
$query = "INSERT INTO lojas (nome, endereco, cidade, codigo_postal, telefone) VALUES ('$nome', '$endereco', '$cidade', '$codigo_postal', '$telefone')";
mysqli_query($conexao, $query);

// Obter o ID da loja recém-adicionada
$loja_id = mysqli_insert_id($conexao);

// Associar os produtos à loja na tabela "lojas_produtos"
foreach ($produtos as $produto_id) {
  $query = "INSERT INTO lojas_produtos (loja_id, produto_id) VALUES ('$loja_id', '$produto_id')";
  mysqli_query($conexao, $query);
}

// Redirecionar de volta para a página inicial
header("Location: pagina_de_admin.");
exit();
?>
