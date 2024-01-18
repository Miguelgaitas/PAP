<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_usuario'])) {
    $questionId = $_POST['question_id'];
    $answerContent = $_POST['answer_content'];
    $authorId = $_SESSION['id_usuario']; // Obter o ID do usuário da sessão

    $query = "INSERT INTO respostas (pergunta_id, resposta, autor_id) VALUES ($questionId, '$answerContent', $authorId)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: perguntas_e_respostas.php"); // Redirecionar para a página principal
    } else {
        echo "Erro ao enviar resposta: " . mysqli_error($conn);
    }
} else {
    echo "Você não está logado ou não enviou uma resposta válida.";
}
?>
 