<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="register.css">
  <meta http-equiv="Content-Type" content="application/json; charset=utf-8">
</head>
<body>
  <h1>Inscription</h1>
  <form action="register.php" method="POST">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required><br><br>

    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" required>
    <p id="email-error-message" class="error-message"></p><br>

    <label for="mot_de_passe">Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br><br>

    <input type="submit" value="S'inscrire">
  </form>

  <script src="register.js"></script>
</body>
</html>
