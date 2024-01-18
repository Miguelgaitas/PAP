<?php
// Início da sessão
session_start();

// Verificação se o usuário está conectado
if (isset($_SESSION['id_usuario'])) {
  // Conecte-se ao banco de dados
  $servername = "localhost";
  $username = "id20757658_miguelgaitas";
  $password = "MiguelGaitas24.";
  $dbname = "id20757658_dados_dos_registros";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
  }

  // Recuperar o ID do usuário da sessão
  $user_id = $_SESSION['id_usuario'];

  // Consulta para recuperar os detalhes do usuário com base no ID
  $sql = "SELECT nome, email FROM usuarios WHERE id = $user_id";
  $resultado = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultado) == 1) {
    // Exibir os detalhes do usuário
    $row = mysqli_fetch_assoc($resultado);
    ?>
    <!DOCTYPE html>
    <html>

    <head>
      <link rel="icon" href="./imagens/favicon-32x32.png">
      <title>Detalhes do Utilizador</title>
      <style>
        /*The eye icon on the password can be stylize with any tool you want
                to use (the only way i know to do this correctly is using JS)
                this is meant to be wide supported and it really depends on you browsers
                if i realize any way to stylize the eye it could be added in the future
                in other input type*/
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'poppins', sans-serif;

        }

        body {
          display: flex;
          justify-content: center;
          flex-direction: column;
          align-items: center;
          min-height: 100vh;
          background-color: black;
          background-size: cover;
          background-position: center;
        }

        .container {
          font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
          font-style: italic;
          font-weight: bold;
          display: flex;
          margin: auto;
          aspect-ratio: 16/9;
          align-items: center;
          justify-items: center;
          justify-content: center;
          flex-direction: column;
          gap: 1em;
        }

        .input-container {
          filter: drop-shadow(46px 36px 24px #4090b5) drop-shadow(-55px -40px 25px #9e30a9);
          animation: blinkShadowsFilter 8s ease-in infinite;
        }

        .input-content {
          display: grid;
          align-content: center;
          justify-items: center;
          align-items: center;
          text-align: center;
          padding-inline: 1em;
        }

        .input-content::before {
          content: "";
          position: absolute;
          width: 100%;
          height: 100%;
          filter: blur(40px);
          -webkit-clip-path: polygon(26% 0, 66% 0, 92% 0, 100% 8%, 100% 89%, 91% 100%, 7% 100%, 0 92%, 0 0);
          clip-path: polygon(26% 0, 66% 0, 92% 0, 100% 8%, 100% 89%, 91% 100%, 7% 100%, 0 92%, 0 0);
          background: rgba(255, 0, 0,  0.5568627451);
          transition: all 1s ease-in-out;
        }

        .input-content::after {
          content: "";
          position: absolute;
          width: 98%;
          height: 98%;
          box-shadow: inset 0px 0px 20px 20px #212121;
          background: repeating-linear-gradient(to bottom, transparent 0%, rgba(64, 144, 181, 0.6) 1px, rgb(0, 0, 0) 3px, hsl(295, 60%, 12%) 5px, #153544 4px, transparent 0.5%), repeating-linear-gradient(to left, hsl(295, 60%, 12%) 100%, hsla(295, 60%, 12%, 0.99) 100%);
          -webkit-clip-path: polygon(26% 0, 31% 5%, 61% 5%, 66% 0, 92% 0, 100% 8%, 100% 89%, 91% 100%, 7% 100%, 0 92%, 0 0);
          clip-path: polygon(26% 0, 31% 5%, 61% 5%, 66% 0, 92% 0, 100% 8%, 100% 89%, 91% 100%, 7% 100%, 0 92%, 0 0);
          animation: backglitch 50ms linear infinite;
        }

        .input-dist {
          z-index: 80;
          display: grid;
          align-items: center;
          text-align: center;
          width: 100%;
          padding-inline: 1em;
          padding-block: 1.2em;
          grid-template-columns: 1fr;
        }

        .input-type {
          display: flex;
          flex-wrap: wrap;
          flex-direction: column;
          gap: 1em;
          font-size: 1.1rem;
          background-color: transparent;
          width: 100%;
          border: none;
        }

        .input-is {
          color: #fff;
          font-size: 0.9rem;
          background-color: transparent;
          width: 100%;
          box-sizing: border-box;
          padding-inline: 0.5em;
          padding-block: 0.7em;
          border: none;
          transition: all 1s ease-in-out;
          border-bottom: 1px solid hsl(221, 26%, 43%);
        }

        .input-is:hover {
          transition: all 1s ease-in-out;
          background: linear-gradient(90deg, transparent 0%, rgba(102, 224, 255, 0.2) 27%, rgba(102, 224, 255, 0.2) 63%, transparent 100%);
        }

        .input-content:focus-within::before {
          transition: all 1s ease-in-out;
          background: hsla(0, 0%, 100%, 0.814);
        }

        .input-is:focus {
          outline: none;
          border-bottom: 1px solid hsl(192, 100%, 100%);
          color: hsl(192, 100%, 88%);
          background: linear-gradient(90deg, transparent 0%, rgba(102, 224, 255, 0.2) 27%, rgba(102, 224, 255, 0.2) 63%, transparent 100%);
        }

        .input-is::-moz-placeholder {
          color: hsla(192, 100%, 88%, 0.806);
        }

        .input-is::placeholder {
          color: hsla(192, 100%, 88%, 0.806);
        }

        @keyframes backglitch {
          0% {
            box-shadow: inset 0px 20px 20px 30px #212121;
          }

          50% {
            box-shadow: inset 0px -20px 20px 30px hsl(297, 42%, 10%);
          }

          to {
            box-shadow: inset 0px 20px 20px 30px #212121;
          }
        }

        @keyframes rotate {
          0% {
            transform: rotate(0deg) translate(-50%, 20%);
          }

          50% {
            transform: rotate(180deg) translate(40%, 10%);
          }

          to {
            transform: rotate(360deg) translate(-50%, 20%);
          }
        }

        @keyframes blinkShadowsFilter {
          0% {
            filter: drop-shadow(46px 36px 28px rgba(255, 0, 0, 0.3411764706)) drop-shadow(-55px -40px 28px #f10000);
          }

          25% {
            filter: drop-shadow(46px -36px 24px rgba(255, 0, 0, 0.3411764706)) drop-shadow(-55px 40px 24px #f10000);
          }

          50% {
            filter: drop-shadow(46px 36px 30px rgba(255, 0, 0, 0.8980392157)) drop-shadow(-55px 40px 30px rgba(255, 20, 20, 0.2941176471));
          }

          75% {
            filter: drop-shadow(20px -18px 25px rgba(255, 0, 0, 0.8980392157)) drop-shadow(-20px 20px 25px rgba(255, 20, 20, 0.2941176471));
          }

          to {
            filter: drop-shadow(46px 36px 28px rgba(255, 0, 0, 0.3411764706)) drop-shadow(-55px -40px 28px #f10000);
          }
        }

        p {
          color: white;
        }

        button {
          width: 165px;
          height: 62px;
          cursor: pointer;
          color: #fff;
          font-size: 17px;
          border-radius: 1rem;
          border: none;
          position: relative;
          background: #100720;
          transition: 0.1s;
        }

        button::after {
          content: '';
          width: 100%;
          height: 100%;
          background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(255, 0, 0) 17.8%, rgba(255, 20, 20) 100.2%);
          filter: blur(15px);
          z-index: -1;
          position: absolute;
          left: 0;
          top: 0;
        }

        button:active {
          transform: scale(0.9) rotate(3deg);
          background: radial-gradient(circle farthest-corner at 10% 20%, rgba(255, 94, 247, 1) 17.8%, rgba(2, 245, 255, 1) 100.2%);
          transition: 0.5s;
        }

        h2 {
          color: white;
        }

        .btned {
          display: flex;
          flex-direction: row;
        }

        .btned button {
          margin: 20px;
        }
      </style>
    </head>

    <body>
      <div class="container">
        <div class="input-container">
          <div class="input-content">
            <div class="input-dist">
              <div class="input-type">
                <h2>Detalhes do Utilizador</h2>
                <p><strong>Nome:</strong>
                  <?php echo $row['nome']; ?>
                </p>
                <br>
                <p><strong>Email:</strong>
                  <?php echo $row['email']; ?>
                </p>
                <br>

              </div>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="btned">
          <button class="edit-btn" onclick="window.location.href='editar_detalhes.php'">Editar informações</button>

          <button class="edit-btn" onclick="window.location.href='primeira_pagina.php'">Voltar para a pagina inicial
            </buttaon>

            <?php
            // Configurações do banco de dados
            $servername = "localhost";
            $username = "id20757658_miguelgaitas";
            $password = "MiguelGaitas24.";
            $dbname = "id20757658_dados_dos_registros";

            // Cria a conexão com o banco de dados
            $conexao = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão com o banco de dados
            if ($conexao->connect_error) {
              die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
            }

            // Função para verificar se o usuário é administrador
            function isAdmin($conexao, $id_usuario)
            {
              // Substitua isso pela lógica real de verificação no lado do servidor
              $consulta = "SELECT admin FROM usuarios WHERE id = $id_usuario";
              $resultado = $conexao->query($consulta);

              if ($resultado) {
                $usuarioAtual = $resultado->fetch_assoc();
                return $usuarioAtual['admin'] == 1;
              } else {
                die("Erro na consulta: " . $conexao->error);
              }
            }

            // Substitua isso pela lógica real para obter o ID do usuário autenticado em sua aplicação
// Exemplo: você pode estar usando uma variável de sessão para armazenar o ID do usuário após o login.
            $id_usuario_autenticado = $_SESSION['id_usuario']; // Certifique-se de iniciar a sessão antes de acessar $_SESSION.
        
            // Se o usuário for um administrador, exibe o botão e redireciona para a página de administração ao clicar
            if (isAdmin($conexao, $id_usuario_autenticado)) {
              // Display the admin button
              echo '<button id="adminButton" onclick="redirectAdmin()" class="edit-btn">Administração</button>';
              echo '<script>
                      function redirectAdmin() {
                          window.location.href = "admin_password.php"; // Redirect to the password entry page
                      }
                    </script>';
          
            }

            // Fecha a conexão com o banco de dados
            $conexao->close();
            ?>


            <button class="edit-btn" onclick="window.location.href='index.html'">Logout</button>
        </div>
      </div>

    </body>

    </html>
    <?php
  } else {
    echo "Nenhum usuário encontrado com o ID fornecido.";
  }

  mysqli_close($conn);
} else {
  echo "Usuário não está conectado.";
}
?>