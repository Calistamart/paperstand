<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Récupération des informations de l'utilisateur depuis la base de données
    $sql_select = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql_select);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hash = $row["mot_de_passe"];
        $is_validated = $row["is_validated"];

        // Vérification du mot de passe hashé
        if (password_verify($mot_de_passe, $hash)) {
            // Récupération de l'ID de l'utilisateur
            $user_id = $row['id'];

            // Stockage de l'adresse e-mail et de l'ID de l'utilisateur dans la session
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['permission_level'] = $row['permission_level'];
            $_SESSION['is_validated'] = $is_validated;

            // Redirection vers la page d'accueil
            header("Location: ../index.php");
            exit();
        } else {
            // Mot de passe incorrect, redirection vers la page de connexion avec un message d'erreur
            header("Location: connexion.php?error=password");
            exit();
        }
    } else {
        // Adresse e-mail incorrecte, redirection vers la page de connexion avec un message d'erreur
        header("Location: connexion.php?error=email");
        exit();
    }

    // Fermeture de la connexion
    $conn->close();
}
?>

<?php 

    if (isset($_GET['error']) && $_GET['error'] == 'password') {
        echo "<p class='error'>Mot de passe incorrect !</p>";
    } else if (isset($_GET['error']) && $_GET['error'] == 'email') {
        echo "<p class='error'>Adresse mail inexistante !</p>";
    } else if (isset($_GET['error']) && $_GET['error'] == 'validation') {
        echo "<p class='error'>Votre compte n'est pas encore validé. Veuillez attendre la validation de votre compte.</p>";
    }

?>
