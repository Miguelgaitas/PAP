<?php
$host = "localhost"; // Substitua pelo seu host do MySQL
$usuario = "id20757658_miguelgaitas"; // Substitua pelo seu usuário do MySQL
$senha = "MiguelGaitas24."; // Substitua pela senha do MySQL
$banco = "id20757658_dados_dos_registros"; // Substitua pelo nome do banco de dados

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}
?>

