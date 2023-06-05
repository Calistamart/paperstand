<?php
session_start();

// Vérifier si aucune session active
if (!isset($_SESSION['email'])) {
  header("Location: /projet/connect/connexion.php");
  exit();
}

// Vérifier si l'utilisateur est administrateur
if ($_SESSION['permission_level'] != 1 && $_SESSION['permission_level'] != 2) {
  header("Location: /projet/index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Panel administrateur</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .sidebar {
      width: 200px;
      height: 100vh;
      background-color: #f1f1f1;
      float: left;
    }

    .content {
      margin-left: 200px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <ul>
      <li><a href="?page=admin_accounts">Utilisateurs</a></li>
      <li><a href="?page=admin_articles">Articles</a></li>
      <li><a href="?page=admin_comments">Commentaires</a></li>
      <li><a href="/projet/index.php">Retour à l'accueil</a></li> <!-- Bouton "Retour à l'accueil" -->
    </ul>
  </div>
  <div class="content">
    <?php
      // Inclure le contenu de la page choisie
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page === 'admin_accounts') {
          include 'admin_accounts.php';
        } elseif ($page === 'admin_articles') {
          include 'admin_articles.php';
        } elseif ($page === 'admin_comments') {
          include 'admin_comments.php';
        }
      } else {
        include 'admin_accounts.php';
      }
    ?>
  </div>
</body>
</html>
