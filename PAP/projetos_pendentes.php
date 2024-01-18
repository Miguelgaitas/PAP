<?php
include("./verificaradm.php");

// Conexão com o banco de dados
$servername = "localhost";
$username = "id20757658_miguelgaitas";
$password = "MiguelGaitas24.";
$dbname = "id20757658_dados_dos_registros"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para recuperar projetos pendentes
$sql = "SELECT * FROM projetos_arduino WHERE status = 'pendente'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <title>Projetos Pendentes</title>
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
    color: white;
}

ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
p{
    color: #fff;
}
li {
    background: rgba(255, 255, 255, 0.8);
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

a {
    text-decoration: none;
    color: #162938;
}

a:hover {
    text-decoration: underline;
}

.admin-button {
    text-align: center;
    margin-top: 20px;
}

.admin-button a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #162938;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.admin-button a:hover {
    background-color: #fff;
    color: #162938;
}

    </style>
</head>
<body>
    <h1>Projetos Pendentes para Verificação</h1>

    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $projetoId = $row["id"];
                $nomeProjeto = $row["nome"];
                $descricaoProjeto = $row["descricao"];

                echo "<li>";
                echo "<a href='verificar_projeto.php?id=$projetoId'>";
                echo "<strong>Nome:</strong> $nomeProjeto<br>";
                
                echo "</a>";
                echo "</li>";
            }
        } else {
            echo "<p>Nenhum projeto pendente para verificação.</p>";
        }
        ?>
    </ul>
    <div class="admin-button">
        <a href="pagina_de_admin.php">Página de Administração</a>
    </div>
</body>
</html>

<?php
// Feche a conexão com o banco de dados
$conn->close();
?>
