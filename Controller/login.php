<?php
session_start();

class LoginController {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "calista";
        $password = "A2Xv6E65m8gzfK";
        $dbname = "paperstand";

        // Création de la connexion
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($this->conn->connect_error) {
            die("La connexion a échoué : " . $this->conn->connect_error);
        }
    }

    public function processRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Récupération des informations de l'utilisateur depuis la base de données
            $sql_select = "SELECT * FROM Users WHERE email = ?";
            $stmt = $this->conn->prepare($sql_select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

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
                    $this->redirectWithError("password");
                }
            } else {
                // Adresse e-mail incorrecte, redirection vers la page de connexion avec un message d'erreur
                $this->redirectWithError("email");
            }
        }
    }

    private function redirectWithError($error) {
        // Redirection vers la page de connexion avec un message d'erreur spécifique
        header("Location: connexion.php?error=$error");
        exit();
    }

    public function displayErrorMessages() {
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            $errorMessages = [
                'password' => "Mot de passe incorrect !",
                'email' => "Adresse e-mail inexistante !",
                'validation' => "Votre compte n'est pas encore validé. Veuillez attendre la validation de votre compte."
            ];

            if (array_key_exists($error, $errorMessages)) {
                echo "<p class='error'>" . $errorMessages[$error] . "</p>";
            }
        }
    }

    public function __destruct() {
        // Fermeture de la connexion
        $this->conn->close();
    }
}

// Utilisation du contrôleur
$loginController = new LoginController();
$loginController->processRequest();
?>
