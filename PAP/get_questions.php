<?php
include 'db.php';

$query = "SELECT * FROM perguntas ORDER BY data_publicacao DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='question'>";
    echo"<h2>Titulo da pergunta :</h2>";
    echo "<p>" . $row['titulo'] . "<p>";
    echo"<h2>Conteúdo da pergunta :</h2>";
    
    echo "<p>" . $row['pergunta'] . "</p>";
    echo "<br>";
    
    $authorId = $row['autor_id'];
    $authorQuery = "SELECT nome FROM usuarios WHERE id = $authorId";
    $authorResult = mysqli_query($conn, $authorQuery);
    $authorRow = mysqli_fetch_assoc($authorResult);
    
    echo "<p class='author'>Por: " . $authorRow['nome'] . "</p>";
    
    echo "<button class='toggle-button' onclick='toggleAnswers(" . $row['id'] . ")'>Mostrar Respostas</button>";
    
    echo "<div id='answers-" . $row['id'] . "' class='answers'>";
    $answersQuery = "SELECT r.*, u.nome AS autor_resposta FROM respostas r JOIN usuarios u ON r.autor_id = u.id WHERE r.pergunta_id = " . $row['id'];
    $answersResult = mysqli_query($conn, $answersQuery);
    
    while ($answerRow = mysqli_fetch_assoc($answersResult)) {
        echo "<div class='answer'>";
        echo "<p>" . $answerRow['resposta'] . "</p>";
        echo "<p class='answer-author'>Respondido por: " . $answerRow['autor_resposta'] . "</p>";
        echo "</div>";
    }
    
    echo "</div>"; // Fechando a div de respostas
    
    echo "<form action='submit_answer.php' method='post'>";
    echo "<br>";
    echo "<input type='hidden' name='question_id' value='" . $row['id'] . "'>";
    echo "<textarea name='answer_content' placeholder='Sua resposta' required></textarea>";
    echo "<br>";
    echo "<button type='submit' style='background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;'>Responder</button>";
    echo "</form>";
    
    echo "</div>"; // Fechando a div de pergunta
}

mysqli_close($conn);
?>
 