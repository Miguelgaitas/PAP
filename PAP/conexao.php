<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros";


// Cria a conexão com o banco de dados
$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Verifica a conexão
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
