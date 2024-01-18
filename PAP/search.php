<?php
// Conexão com o banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar a consulta da barra de pesquisa
if(isset($_POST['query'])) {
    $search = $_POST['query'];
    
    // Consulta SQL para buscar produtos com o nome da loja
    $sql = "SELECT produtos.nome, produtos.descricao, produtos.quantidade_em_stock, produtos.preco, lojas.nome as nome_lojas
    FROM produtos 
    INNER JOIN lojas_produtos ON produtos.id = lojas_produtos.produto_id INNER JOIN lojas ON lojas_produtos.loja_id = lojas.id 
    WHERE produtos.nome LIKE '%$search%'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nome</th><th>Descrição</th><th>Preço</th><th>Quantidade em Estoque</th><th>Loja</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["descricao"] . "</td>";
            echo "<td>€" . $row["preco"] . "</td>";
            echo "<td>" . $row["quantidade_em_stock"] . "</td>";
            echo "<td>" . $row["nome_lojas"] . "</td>";
            echo "<br><br><br>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum resultado encontrado.</p>";
    }
    
}

$conn->close();
?>
