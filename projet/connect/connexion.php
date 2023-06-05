<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Connexion</h1>
    <?php 
    if (isset($_GET['error']) && $_GET['error'] == 'password') {
        echo "<p class='error'>Mot de passe incorrect !</p>";
    } else if (isset($_GET['error']) && $_GET['error'] == 'email') {
        echo "<p class='error'>Adresse mail inexistante !</p>";
    } else if (isset($_GET['error']) && $_GET['error'] == 'validation') {
        echo "<p class='error'>Votre compte n'est pas encore validé. Veuillez attendre la validation de votre compte.</p>";
    }
    ?>
    <form action="login.php" method="POST">
        <label for="email">Adresse email :</label>
        <input type="email" name="email" required autocomplete="username"><br><br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required autocomplete="current-password"><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
