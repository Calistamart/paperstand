<?php
session_start();

if (!isset($_SESSION['email']) || ($_SESSION['permission_level'] != 1 && $_SESSION['permission_level'] != 2)) {
  header("Location: /projet/connect/connexion.php");
  exit();
}

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

// Réinitialisation du mot de passe si un identifiant est fourni
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Vérification du type d'action
  if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    // Mise à jour du mot de passe dans la base de données
    $sql_reset_password = "UPDATE Users SET mot_de_passe='' WHERE id=$id";
    if ($conn->query($sql_reset_password) === TRUE) {
      echo "Mot de passe réinitialisé avec succès.";
    } else {
      echo "Erreur lors de la réinitialisation du mot de passe : " . $conn->error;
    }
  } else if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    // Suppression du compte de la base de données
    $sql_delete_account = "DELETE FROM Users WHERE id=$id";
    if ($conn->query($sql_delete_account) === TRUE) {
      echo "Compte supprimé avec succès.";
    } else {
      echo "Erreur lors de la suppression du compte : " . $conn->error;
    }
  } else if (isset($_GET['action']) && $_GET['action'] === 'validate') {
    // Validation du compte dans la base de données
    $sql_validate_account = "UPDATE Users SET is_validated=1 WHERE id=$id";
    if ($conn->query($sql_validate_account) === TRUE) {
      echo "Compte validé avec succès.";
    } else {
      echo "Erreur lors de la validation du compte : " . $conn->error;
    }
  }
}

// Récupération de tous les comptes non validés
$sql_select_pending_Users = "SELECT * FROM Users WHERE is_validated = 0";
$result_select_pending_Users = $conn->query($sql_select_pending_Users);

// Récupération de tous les comptes validés
$sql_select_validated_Users = "SELECT * FROM Users WHERE is_validated = 1";
$result_select_validated_Users = $conn->query($sql_select_validated_Users);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Panel administrateur</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Panel administrateur</h1>

  <h2>Comptes en attente de validation</h2>
  <table>
    <tr>
      <th>Pseudo</th>
      <th>Email</th>
      <th>Réinitialiser mot de passe</th>
      <th>Action</th>
      <th>Valider le compte</th>
    </tr>
    <?php
    if ($result_select_pending_Users->num_rows > 0) {
      while ($row = $result_select_pending_Users->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['pseudo'] . "</td>
                <td>" . $row['email'] . "</td>
                <td><a href=\"javascript:void(0);\" onclick=\"resetPassword(" . $row['id'] . ")\">Réinitialiser</a></td>
                <td><a href=\"javascript:void(0);\" onclick=\"deleteAccount(" . $row['id'] . ")\">Supprimer</a></td>
                <td><a href=\"javascript:void(0);\" onclick=\"validateAccount(" . $row['id'] . ")\">Valider</a></td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='5'>Aucun compte en attente de validation.</td></tr>";
    }
    ?>
  </table>

  <h2>Comptes validés</h2>
  <table>
    <tr>
      <th>Pseudo</th>
      <th>Email</th>
      <th>Réinitialiser mot de passe</th>
      <th>Action</th>
    </tr>
    <?php
    if ($result_select_validated_Users->num_rows > 0) {
      while ($row = $result_select_validated_Users->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['pseudo'] . "</td>
                <td>" . $row['email'] . "</td>
                <td><a href=\"javascript:void(0);\" onclick=\"resetPassword(" . $row['id'] . ")\">Réinitialiser</a></td>
                <td><a href=\"javascript:void(0);\" onclick=\"deleteAccount(" . $row['id'] . ")\">Supprimer</a>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='2'>Aucun compte validé.</td></tr>";
    }
    ?>
  </table>

  <script src="script.js"></script>
</body>
</html>
