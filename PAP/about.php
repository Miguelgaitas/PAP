<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="./imagens/favicon-32x32.png">
    <title>About</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;

        }

        body {
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://i.pinimg.com/originals/09/64/a7/0964a7c66f449a148686bc265eaeaec8.jpg') repeat;
            background-size: cover;
            background-position: center;
        }
        

        .warpper {
            position: relative;
            width: 400px;
            height: 440px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: transform .5s ease, heigth .2s ease;
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

        .container {

    top: 0px; /* Alterado para 50 pixels do topo */
    margin-top: 180px;
    text-align: center; /* Alinha o texto ao centro */
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
            margin-left: 40px;
            transition: .5s;
        }

        .navigation .btnlogin-popup:hover {
            background: #fff;
            color: #162938;
        }

        h1 {
            font-size: 48px;
            margin-top: 20px;
            text-align: center;
            color: white;
            text-shadow: 1px 1px #fff;
        }

        p {
            font-size: 24px;
            margin-top: 32px;
            text-align: center;
            color: white;
            text-shadow: 1px 1px #fff;
        }
 /* Adiciona estilo ao vídeo */
 .video-container {
            width: 80%; /* Reduzi a largura para 80% */
            max-width: 800px;
            margin: 40px auto; /* Aumentei a margem para 40px */
            align-items: ;
        }

        video {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <header>
        <h2 class="logo">
            <img src="./imagens/Capturar-removebg-preview.png" alt="Logo" class="logo-image" style="width: 200px; height: auto;">
        </h2>
        <nav class="navigation">
            <a href="index.html">Pagina Inicial</a>
            <a href="contact1.php">Contacto</a>
            <button onclick="window.location.href= './login.php';" class="btnlogin-popup">Iniciar Sessão</button>
        </nav>
    </header>

    <div class="container">
        <h1>Bem-vindo(a) ao Site de Formação em Arduino: Aprenda, Experimente e Crie!</h1>

        <div class="video-container">
        <video controls>
            <source src="imagens\1.mp4" type="video/mp4">
            Seu navegador não suporta o elemento de vídeo.
        </video>
        <p>
            Sou o Bruno Miguel Gouveia Vieira e criei este site de formação em Arduino para ajudá-lo a aprender, a experimentar e a criar projetos com esta incrível plataforma eletrónica. Aqui encontrará tutoriais, trabalhos e recursos didáticos para estudar desde o básico até níveis avançados. Junte-se a mim nesta jornada de aprendizagem colaborativa e divirta-se explorando o mundo do Arduino! <br><br>
            
            Atenciosamente,
            Bruno Miguel Gouveia Vieira
            Turma 12ºJ - TGPSI (2021/2024)
        </p>
    </div>

    <!-- Adicione esta seção para incorporar um vídeo -->
  

</body>
</html>