<!DOCTYPE html>
<html>
<head>
  <title>База данных</title>
</head>
<body>
    <h1>Админ панель</h1>
<h2>Добавление данных</h2>
<form action="add.php" method="post">
    <input type="text" name="login" placeholder="login"> <br><br>
    <input type="email" name="email" placeholder="Email"> <br><br>
    <input type="password" name="password" placeholder="password"> <br><br>
    <input type="text" name="role" placeholder="role"> <br><br>
    <button type="submit">Add User</button>
</form>

<h2>Обновление данных</h2> <form action="edit.php" method="post">
    <label for="id_user">User ID:</label><br>
    <input type="text" id="id_user" name="id_user"><br><br>
    <label for="login">New Login:</label><br>
    <input type="text" id="login" name="login"><br><br>
    <label for="email">New Email:</label><br> 
    <input type="email" id="email" name="email"><br><br>
    <label for="password">New Password:</label><br> 
    <input type="password" id="password" name="password"><br><br>

<input type="submit" value="Update User"> </form>
<h2>Запросы к базе данных</h2>
<?php 
 $conn = mysqli_connect('localhost', 'root', '', 'orders');
if ($conn == false) { echo 'Ошибка при подключении к бд'; exit; }
// Выполнение запросов и вывод результата 
$sql_queries = [ "SELECT * FROM orders WHERE id_master = '2';", "SELECT * FROM orders WHERE cost > 200000;", "SELECT * FROM orders WHERE id_user = '15';",  "SELECT id__good, COUNT(*) AS product_composition FROM orders GROUP BY id__good;", "SELECT id_user FROM orders GROUP BY id_user HAVING SUM(cost) > 100000;", "SELECT * FROM orders WHERE date_of_creation > '2024-06-27';", "SELECT * FROM orders WHERE date_of_readiness BETWEEN '2024-06-27' AND '2024-06-30';", "SELECT id__good, COUNT(*) AS product_composition, GROUP_CONCAT(comment) AS comments FROM orders GROUP BY id__good;", "SELECT name, COUNT(*) AS count FROM goods GROUP BY name;", "SELECT DISTINCT id_master FROM orders WHERE product_composition IN ('Gold');" ];

foreach ($sql_queries as $query) { $result = $conn->query($query);

 
if ($result->num_rows > 0) {
    echo "<h3>Query: $query</h3>";
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach($row as $key => $value) {
            echo "<td>$key: $value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results for query: $query";
}
echo "<br>";
}

$conn->close(); 
?>
<h2>Вывод БД</h2>
<h3>Таблица "User"</h3>
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

// Запрос данных из таблицы
$sql = "SELECT id_user, login, email, password, role FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>password</th><th>role</th><th>Delete</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id_user']."</td>";
        echo "<td>".$row['login']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "<td>".$row['role']."</td>";
        echo "<td><a href='http://localhost/ukrashenia/admin_panel/delete.php?id=".$row['id_user']."'>Delete</a>
</td>";
        echo "</tr>";
    }
    
} else {
    echo "0 results";
}

$sql = "SELECT id_master, name FROM masters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id_master']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td><a href='http://localhost/ukrashenia/admin_panel/delete.php?id=".$row['id_master']."'>Delete</a>
</td>";
        echo "</tr>";
    }
    
} else {
    echo "0 results";
}

$sql = "SELECT id__good, name, quantity FROM goods"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) { echo "<table>"; echo "<tr><th>ID</th><th>Name</th><th>quantity</th></tr>";

 
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['id__good']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td><a href='http://localhost/ukrashenia/admin_panel/delete.php?id=".$row['id__good']."'>Delete</a></td>";
    echo "</tr>";
}
} 
else { echo "0 results"; 
}
$sql = "SELECT id_orders, id_user, email, id__good, product_composition, id_master, comment, order_status, date_of_creation, date_of_readiness, cost FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>User</th><th>Email</th><th>ID_good</th><th>product_composition</th><th>comment</th><th>order_status</th><th>date_of_creation</th><th>date_of_readiness</th><th>cost</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id_orders']."</td>";
        echo "<td>".$row['id_user']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['id__good']."</td>";
        echo "<td>".$row['product_composition']."</td>";
        echo "<td>".$row['comment']."</td>";
        echo "<td>".$row['order_status']."</td>";
        echo "<td>".$row['date_of_creation']."</td>";
        echo "<td>".$row['date_of_readiness']."</td>";
        echo "<td>".$row['cost']."</td>";
        echo "<td><a href='http://localhost/ukrashenia/admin_panel/delete.php?id=".$row['id_orders']."'>Delete</a>
</td>";
        echo "</tr>";
    }
    
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>