<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $username = "calista";
  $password = "A2Xv6E65m8gzfK";
  $dbname = "paperstand";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
  }
  
  $email = $_POST["email"];
  
  $sql_check_email = "SELECT * FROM Users WHERE email = '$email'";
  $result = $conn->query($sql_check_email);
  $exists = ($result->num_rows > 0);
  
  $conn->close();
  
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array("exists" => $exists));
}
?>
