<?php
session_start();

require 'account_model.php';
require 'account_view.php';
require 'account_controller.php';

// Connexion à la base de données
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

$model = new AccountModel($conn);
$view = new AccountView();
$controller = new AccountController($model, $view);

$email = $_SESSION['email'];

$controller->displayAccount($email);

// Vérification des soumissions de formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST["mot_de_passe_actuel"];
    $newPassword = $_POST["nouveau_mot_de_passe"];
    
    $controller->updatePassword($email, $currentPassword, $newPassword);
}
?>