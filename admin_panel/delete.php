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

// Проверяем, был ли отправлен запрос на удаление
if (isset($_GET['id'])) {
    // Получаем ID пользователя для удаления
    $id = $_GET['id'];

    // Запрос на удаление данных из таблицы
    $sql = "DELETE FROM user WHERE id_user = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно удалена";
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM masters WHERE id_master = $id";
    
    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM goods WHERE id__good = $id";
    
    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM orders WHERE id_orders = $id";
    
    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>