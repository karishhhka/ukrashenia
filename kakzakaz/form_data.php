<?php
$conn = mysqli_connect('localhost', 'root', '', 'orders');

if ($conn == false) {
    echo 'Ошибка при подключении к бд';
    exit;
}

$email = $_POST['email'];
$sql_check_email = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    // Если email найден в таблице user
    $user_row = $result->fetch_assoc();
    $id_user = $user_row['id_user'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product = $_POST['product'];
        $structure = $_POST['structure'];
        $master = $_POST['master'];
        $comment = $_POST['comment'];

        if (empty($product) || empty($structure) || empty($master) || empty($comment)) {
            echo "Ошибка: Пожалуйста, заполните все поля перед отправкой формы.";
        } else {
            $date_of_creation = date("Y-m-d");

            $sql = "INSERT INTO orders (id_user, email, id__good, product_composition, id_master, comment, order_status, date_of_creation) VALUES ('$id_user', '$email', '$product', '$structure', '$master', '$comment', 'не готов', '$date_of_creation')";

            if ($conn->query($sql) === TRUE) {
                echo "Запись успешно добавлена в базу данных.";
            } else {
                echo "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
} else {
    echo "Пользователь не авторизован. Пожалуйста, войдите в свою учетную запись чтобы оформить заказ.";
    $conn->close();
}
?>
<br>
<a href="http://localhost/ukrashenia/kakzakaz/index.html">Вернуться на главную страницу</a>