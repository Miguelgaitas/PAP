<?php

session_start();

// Check if the user is an admin and the admin password is not entered
if ($_SESSION['isAdmin'] == true && $_SESSION["senhaadm"] != 1) {
    // Redirect the user to the admin password page
    header("Location: admin_password.php");
    return;
}

// Check if the user is not an admin
if ($_SESSION['isAdmin'] == false) {
    echo "no permission";
    header("Location: primeira_pagina.php");
    return;
}

?>
