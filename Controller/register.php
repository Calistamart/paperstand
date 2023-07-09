<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $username = "calista";
  $password = "A2Xv6E65m8gzfK";
  $dbname = "paperstand";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
  }

  $sql_create_table = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    is_validated BOOLEAN NOT NULL DEFAULT FALSE,
    permission_level INT(1) NOT NULL DEFAULT 0
  )";

  if ($conn->query($sql_create_table) === FALSE) {
    echo "Erreur de création de la table : " . $conn->error;
  }

  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

  $sql_insert = "INSERT INTO Users (pseudo, email, mot_de_passe)
                 VALUES ('$pseudo', '$email', '$mot_de_passe')";

  if ($conn->query($sql_insert) === TRUE) {
    echo json_encode(array("success" => "Inscription réussie !"));
  } else {
    $error_message = "Erreur d'inscription : " . $conn->error;
    echo json_encode(array("error" => $error_message));
  }

  $conn->close();
}
?>
