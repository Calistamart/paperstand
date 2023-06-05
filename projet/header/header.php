<?php
session_start();

$servername = "localhost";
$username = "calista";
$password = "A2Xv6E65m8gzfK";
$dbname = "paperstand";

// Établir la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer la valeur de "admin" depuis la session
$isAdmin = $_SESSION['permission_level']; // Assurez-vous que 'permission_level' est la clé correcte pour la valeur de "admin" dans votre session

// Vérifier si l'utilisateur est validé
$isUserValidated = false;

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];

  $sql_check_validation = "SELECT is_validated FROM Users WHERE email='$email'";
  $result_check_validation = $conn->query($sql_check_validation);

  if ($result_check_validation && $result_check_validation->num_rows == 1) {
    $row = $result_check_validation->fetch_assoc();
    $isUserValidated = ($row['is_validated'] == 1);
  }
}

?>

<div id="header">
  <div id="logo">Logo de votre site</div>
  <div id="header-buttons">
    <div class="dropdown">
      <button class="header-button">Mon compte</button>
      <div class="dropdown-content">
        <a href="/projet/account/account.php">Mon compte</a>
        <a href="/projet/connect/deconnexion.php">Se déconnecter</a>
        <?php
        if ($isAdmin == 1 || $isAdmin == 2) {
            echo '<a href="/projet/admin/admin_pannel.php">Admin</a>';
        }

        if ($isUserValidated) {
            echo '<a href="/projet/article_writing/create_article.php">Rédiger un article</a>';
        }
        ?>
      </div>
    </div>
  </div>
</div>




<style>
body {
  margin: 0;
  padding: 0;
}

#header {
  background-color: #ccc;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

#logo {
  font-size: 20px;
  font-weight: bold;
}

#header-buttons {
  display: flex;
  align-items: center;
}

.header-button {
  background-color: #fff;
  color: #333;
  padding: 10px 20px;
  margin-left: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}
</style>
