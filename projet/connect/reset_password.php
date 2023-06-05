<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['new_password'];

    // Update the password in the database
    $email = $_SESSION['email'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    $servername = "localhost";
    $username = "calista";
    $password = "A2Xv6E65m8gzfK";
    $dbname = "paperstand";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    $sql_update_password = "UPDATE accounts SET mot_de_passe='$hashedPassword' WHERE email='$email'";
    if ($conn->query($sql_update_password) === TRUE) {
        // Password reset successful, redirect to the login page
        header("Location: connexion.php");
        exit();
    } else {
        echo "Erreur lors de la réinitialisation du mot de passe : " . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Choisissez un nouveau mot de passe</h1>
    <form action="reset_password.php" method="POST">
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" name="new_password" required><br><br>
        <input type="submit" value="Réinitialiser">
    </form>
</body>
</html>