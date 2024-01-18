<!-- check_admin_password.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminPassword = $_POST["adminPassword"];

    // Perform your password verification here
    // For example, check if $adminPassword matches the expected admin password

    if ($adminPassword == "Gaitas24") {
        $_SESSION["senhaadm"] = 1 ;
        header("Location: pagina_de_admin.php");
        exit();
    } else {
        // Incorrect password, redirect to login page with an error message
        header("Location: detalhesconta.php");
        exit();
    }
} else {
    // Invalid request method, redirect to login page
    header("Location: admin_password.php");
    exit();
}
?>
