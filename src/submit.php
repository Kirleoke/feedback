<?php
$mysqli = new mysqli("db", "user", "user_password", "feedback");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Проверка на наличие email в базе данных
$result = $mysqli->query("SELECT * FROM feedback WHERE email = '$email'");

if ($result->num_rows > 0) {
    echo "Этот email уже зарегистрирован.";
} else {
    $stmt = $mysqli->prepare("INSERT INTO feedback (name, phone, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $email, $message);
    $stmt->execute();

    mail("orangeboom546@mail.ru", "Новое сообщение", $message, "From: $email");

    echo "Ваше сообщение отправлено!";
}
?>
