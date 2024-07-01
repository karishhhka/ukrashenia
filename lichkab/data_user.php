<!-- 
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "orders";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных о заказе и пользователе
$sql = "SELECT * FROM orders WHERE user_id = $_SESSION[user_id]";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Вывод данных о заказе и пользователе в текстовые поля
    while($row = $result->fetch_assoc()) {
        echo "<p class='lichkab__three__info__text'>Статус заказа:</p>";
        echo "<p class='lichkab__three__info__text'>" . $row["status"] . "</p>";

        echo "<p class='lichkab__three__info__text'>Дата добавления заказа:</p>";
        echo "<p class='lichkab__three__info__text'>" . $row["order_date"] . "</p>";

        echo "<p class='lichkab__three__info__text'>Имя пользователя:</p>";
        echo "<p class='lichkab__three__info__text'>" . $row["username"] . "</p>";
    }
} else {
    echo "Данные не найдены";
}

$conn->close();
?> -->
