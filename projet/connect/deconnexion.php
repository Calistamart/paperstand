<?php
session_start();

// Destruction de toutes les variables de session
session_unset();

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion
header("Location: connexion.php");
exit();
?>
