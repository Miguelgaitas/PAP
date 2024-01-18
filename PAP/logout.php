<?php
// Início da sessão
session_start();

// Limpa a sessão
session_unset();
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit();
?>
