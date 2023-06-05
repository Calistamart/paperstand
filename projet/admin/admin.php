<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "calista";
    $password = "A2Xv6E65m8gzfK";
    $dbname = "paperstand";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_SESSION['email'])) {
        // Rediriger vers la page du panel admin
        header("Location: admin/admin_pannel.php");
        exit();
      }

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification de l'adresse e-mail et du mot de passe
    $sql_check_login = "SELECT * FROM Users WHERE email='$email'";
    $result_check_login = $conn->query($sql_check_login);
    if ($result_check_login->num_rows == 1) {
        $row_check_login = $result_check_login->fetch_assoc();
        if (password_verify($mot_de_passe, $row_check_login['mot_de_passe'])) {
            // Connexion réussie
            if ($row_check_login['permission_level'] == 1 || $row_check_login['permission_level'] == 2) {
                header("Location: ../../../projet/admin/admin_pannel.php");
            } else {
                header("Location: ../index.php");
                exit();
            }
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Adresse e-mail incorrecte";
    }

    // Fermeture de la connexion
    $conn->close();

} else {
    // Affichage du formulaire de connexion
    ?>
    <form method="post">
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
    <?php
}
?>
