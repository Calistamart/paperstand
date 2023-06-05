<?php
session_start();

// Vérifier si aucune session active
if (!isset($_SESSION['email'])) {
  header("Location: /projet/connect/connexion.php");
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Liste des soirées</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php include 'header/header.php'; ?>
</body>
</html>
