<?php
$conn = mysqli_connect('localhost', 'root', '', 'orders');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Хеширование пароля
    
    $sql = "INSERT INTO user (login, email, password, role) VALUES ('$login', '$email', '$hashed_password', '$role')"; 
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>