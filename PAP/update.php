<?php
// Configurações do banco de dados MySQL
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";

// Função para criar uma conexão com o banco de dados
function criarConexao() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    return $conn;
}

// Função para gerar um preço aleatório entre 10 e 100
function gerarPrecoAleatorio() {
    return rand(10, 100);
}

// Função para gerar uma quantidade em estoque aleatória entre 1 e 100
function gerarQuantidadeEstoqueAleatoria() {
    return rand(1, 100);
}

// Conecte-se ao banco de dados
$conn = criarConexao();

// Consulta SQL para buscar todos os produtos na tabela "produtos"
$sql = "SELECT id FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtoId = $row['id'];

        // Gere novos valores aleatórios para preço e quantidade em estoque
        $novoPreco = gerarPrecoAleatorio();
        $novaQuantidadeEstoque = gerarQuantidadeEstoqueAleatoria();

        // Consulta SQL para atualizar o produto específico com os novos valores aleatórios
        $atualizarSql = "UPDATE produtos SET preco = ?, quantidade_em_stock = ? WHERE id = ?";
        $stmt = $conn->prepare($atualizarSql);
        $stmt->bind_param("iii", $novoPreco, $novaQuantidadeEstoque, $produtoId);
        
        // Execute a consulta
        if ($stmt->execute()) {
            echo "Dados atualizados com sucesso para o ID " . $produtoId . "<br>";
        } else {
            echo "Erro ao atualizar dados para o ID " . $produtoId . ": " . $stmt->error . "<br>";
        }
        $stmt->close();
    }
} else {
    echo "Nenhum produto encontrado na tabela 'produtos'.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
