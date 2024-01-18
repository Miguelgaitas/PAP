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

// Verifica se foi passado o ID do usuário
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui os projetos associados a este usuário
    $sql_delete_projetos = "DELETE FROM projetos_arduino WHERE autor = $id";
    mysqli_query($conn, $sql_delete_projetos);

    // Exclui o usuário da base de dados
    $sql_delete_usuario = "DELETE FROM usuarios WHERE id = $id";
    mysqli_query($conn, $sql_delete_usuario);

    // Redireciona de volta para a página de gerenciamento de usuários
    header("Location: adminusuarios.php");
    exit;
} else {
    echo "ID do usuário não informado.";
    exit;
}
?>
