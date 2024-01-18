<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $userLoggedIn = true;
} else {
    $userLoggedIn = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins', sans-serif;

}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg')repeat;
    background-size: cover;
    background-position: center;
}
header {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 150px;
			padding: 20px 100px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			z-index: 99;
			backdrop-filter: blur(10px);
			border: 2px solid rgba(255, 255, 255, .5);
			border-radius: 6px;

		}

		.navigation a {
			position: relative;
			font-size: 1.1em;
			color: #fff;
			text-decoration: none;
			font-weight: 500;
			margin-left: 40px;
		}

		.navigation a::after {
			content: '';
			position: absolute;
			left: 0;
			bottom: -6px;
			width: 100%;
			height: 3px;
			background: #fff;
			border-radius: 5px;
			transform-origin: right;
			transform: scaleX(0);
			transition: transform .5s;


		}

		.navigation a:hover::after {
			transform-origin: left;
			transform: scaleX(1);
		}

		.navigation .btnlogin-popup {
			width: 130px;
			height: 50px;
			background: transparent;
			border: 2px solid #fff;
			outline: none;
			border-radius: 6px;
			cursor: pointer;
			font-size: 1.1em;
			color: #fff;
			font-weight: 500;
			margin-left: 20px;
			transition: .5s;
		}

		.navigation .btnlogin-popup:hover {
			background: #fff;
			color: #162938;
		}

main {
    max-width: 800px;
    margin-top: 150px;
    padding: 20px;
}

.question-form {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
}

.question-form h2 {
    margin-bottom: 10px;
}

.question-form input[type="text"],
.question-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.question-form button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.questions {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
}

.question {
    border-bottom: 1px solid #ddd;
    padding: 20px 0;
}

.question h3 {
    margin-bottom: 10px;
}

.question p {
    color: #333;
}

.author {
    font-style: italic;
    color: #888;
    margin-bottom: 5px;
}

.toggle-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.answers {
    display: none;
    padding: 20px 0;
    border-top: 1px solid #ddd;
}

.show-answers {
    display: block;
}

.answer {
    border-top: 1px solid #ddd;
    padding: 20px 0;
}

.answer p {
    color: #555;
}

.answer-author {
    font-style: italic;
    color: #666;
    margin-top: 5px;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}
.form-container {
    width: 400px;
    background: linear-gradient(#212121, #212121) padding-box,
                linear-gradient(145deg, transparent 35%,#e81cff, #40c9ff) border-box;
    border: 2px solid transparent;
    padding: 32px 24px;
    font-size: 14px;
    font-family: inherit;
    color: white;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-sizing: border-box;
    border-radius: 16px;
    background-size: 200% 100%;
    animation: gradient 5s ease infinite;
  }
  
  @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }
  
    50% {
      background-position: 100% 50%;
    }
  
    100% {
      background-position: 0% 50%;
    }
  }
  
  .form-container button:active {
    scale: 0.95;
  }
  
  .form-container .form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .form-container .form-group {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }
  
  .form-container .form-group label {
    display: block;
    margin-bottom: 5px;
    color: #717171;
    font-weight: 600;
    font-size: 12px;
  }
  
  .form-container .form-group input {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    color: #fff;
    font-family: inherit;
    background-color: transparent;
    border: 1px solid #414141;
  }
  
  .form-container .form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    resize: none;
    color: #fff;
    height: 96px;
    border: 1px solid #414141;
    background-color: transparent;
    font-family: inherit;
  }
  
  .form-container .form-group input::placeholder {
    opacity: 0.5;
  }
  
  .form-container .form-group input:focus {
    outline: none;
    border-color: #e81cff;
  }
  
  .form-container .form-group textarea:focus {
    outline: none;
    border-color: #e81cff;
  }
  
  .form-container .form-submit-btn {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    align-self: flex-start;
    font-family: inherit;
    color: #717171;
    font-weight: 600;
    width: 40%;
    background: #313131;
    border: 1px solid #414141;
    padding: 12px 16px;
    font-size: inherit;
    gap: 8px;
    margin-top: 8px;
    cursor: pointer;
    border-radius: 6px;
  }
  
  .form-container .form-submit-btn:hover {
    background-color: #fff;
    border-color: #fff;
  }
    </style>
    <title>Fórum de Perguntas e Respostas</title>
    <link rel="icon" href="./imagens/favicon-32x32.png">
</head>
<body>
<header>
		<h2 class="logo">
			<img src="./imagens/Capturar-removebg-preview.png" alt="Logo" class="logo-image"
				style="width: 148px; height: auto;">
		</h2>
		<nav class="navigation">
			<a href="primeira_pagina.php">Pagína inicial</a>
			<a href="pagina1.php">Projetos</a>
			<a href="pagina2.php">Top 5</a>
			<a href="pagina3.php">Lojas</a>
			<a href="contact.php">Contacto</a>

			<button onclick="window.location.href= './detalhesconta.php';" class="btnlogin-popup">Conta</button>
			</a>
		</nav>
	</header>
    
    <main>
        <section class="question-form">
            <h2>Faça uma pergunta:</h2>
            <form action="submit_question.php" method="post">
                <input type="text" name="question_title" placeholder="Título da pergunta" required>
                <textarea name="question_content" placeholder="Conteúdo da pergunta" required></textarea>
                <button type="submit">Enviar pergunta</button>
            </form>
        </section>

        <section class="questions">
            <h1>Perguntas:</h1>
            <br>
            <?php include 'get_questions.php'; ?>
        </section>
    </main>
    

 
    <script>
        function toggleAnswers(questionId) {
            var answersDiv = document.getElementById("answers-" + questionId);
            answersDiv.classList.toggle("show-answers");
        }
    </script>
</body>
</html>
