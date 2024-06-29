<?php
$mysqli = new mysqli("db", "user", "user_password", "feedback");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$email = $_GET['email'];
$result = $mysqli->query("SELECT * FROM feedback WHERE email = '$email'");

header('Content-Type: application/json');
echo json_encode(['exists' => $result->num_rows > 0]);
?>
