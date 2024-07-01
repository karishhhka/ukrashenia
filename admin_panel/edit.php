<?php
// Подключение к базе данных
$conn = mysqli_connect('localhost', 'root', '', 'orders');

if ($conn == false) {
    echo 'Ошибка при подключении к бд';
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$id = $_POST['id_user'];
$newLogin = $_POST['login'];
$newEmail = $_POST['email'];
$newPassword = $_POST['password'];
// Хеширование пароля
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Запрос на обновление данных с хешированным паролем
$sql = "UPDATE user SET login='$newLogin', email='$newEmail', password='$hashedPassword' WHERE id_user=$id";



if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

