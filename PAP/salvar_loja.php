<?php


include("./verificaradm.php");

?>
<?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "id20757658_miguelgaitas", "MiguelGaitas24.", "id20757658_dados_dos_registros");

// Atualizar informações da loja
$query_loja = "UPDATE lojas SET nome = '".$_POST['nome']."', endereco = '".$_POST['endereco']."', cidade = '".$_POST['cidade']."', codigo_postal = '".$_POST['codigo_postal']."', telefone = '".$_POST['telefone']."' WHERE id = ".$_POST['id'];
mysqli_query($conexao, $query_loja);

// Deletar todos os produtos da loja atual
$query_deletar_produtos_loja = "DELETE FROM lojas_produtos WHERE loja_id = ".$_POST['id'];
mysqli_query($conexao, $query_deletar_produtos_loja);

// Inserir os produtos selecionados na loja atual
if (isset($_POST['produtos'])) {
    foreach ($_POST['produtos'] as $produto_id) {
        $query_inserir_produto_loja = "INSERT INTO lojas_produtos (loja_id, produto_id) VALUES (".$_POST['id'].", ".$produto_id.")";
        mysqli_query($conexao, $query_inserir_produto_loja);
    }
}

// Redirecionar para a página da loja
header("Location: addlojas.php");
exit();
?>
