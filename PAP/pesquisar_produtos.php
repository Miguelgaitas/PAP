<?php

// Conectar ao banco de dados e selecionar a tabela "produtos"

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $pesquisa = $_POST["pesquisa"];
  $sql = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%'";
  $result = mysqli_query($conexao, $sql);
  $produtos = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $produtos[] = $row;
  }
  echo json_encode($produtos);
}

?>
