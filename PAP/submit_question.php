<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_usuario'])) {
    $questionTitle = $_POST['question_title'];
    $questionContent = $_POST['question_content'];
    $authorId = $_SESSION['id_usuario']; // Obter o ID do usuário da sessão

    $query = "INSERT INTO perguntas (titulo, pergunta, autor_id) VALUES ('$questionTitle', '$questionContent', $authorId)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: perguntas_e_respostas.php"); // Redirecionar para a página principal
    } else {
        echo "Erro ao enviar pergunta: " . mysqli_error($conn);
    }
} else {
    echo "Você não está logado ou não enviou uma pergunta válida.";
}
?>
 