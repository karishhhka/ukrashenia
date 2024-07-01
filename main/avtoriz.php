<?php
// подключение к бд
$conn = mysqli_connect('localhost', 'root', '', 'orders');

if ($conn == false) {
    echo 'Ошибка при подключении к бд';
    exit;
}

$login = $_POST['log'];
$pass = $_POST['password'];
$secret = '6LfT-AAqAAAAAPQfsVAU2Eb-FlhTCWoKaAsI4LNU';

// проверка на заполнение полей
if(empty($_POST['log']) || empty($_POST['password'])){
    echo 'Заполните все поля';
    exit;
}

$sql = $conn; // Assign the connection to $sql

$sq = $sql->prepare("SELECT * FROM `user` WHERE `login` = ?");
$sq->bind_param('s', $login);
$sq->execute();
$res = $sq->get_result();
$user = $res->fetch_array(MYSQLI_ASSOC);

if ($res->num_rows == 0) {
    echo 'Пользователь с таким логином не найден';
    exit;
}

$sql = $conn; $sq = $sql->prepare("SELECT * FROM user WHERE login = ?");
 $sq->bind_param('s', $login); $sq->execute(); $res = $sq->get_result(); 
 $user = $res->fetch_array(MYSQLI_ASSOC);

if ($res->num_rows == 0) { echo 'Пользователь с таким логином не найден'; exit; }
// проверка на админа
if ($user['role'] == 0) { header("Location: http://localhost/ukrashenia/lichkab/index.php"); }
     elseif ($user['role'] == 1) { header("Location: http://localhost/ukrashenia/admin_panel/adminka.php"); }

// Сохранение данных пользователя в сессии 
session_start(); 
$_SESSION['login'] = $user['login']; 
$_SESSION['email'] = $user['email'];

echo 'Вы успешно авторизованы!';
?>
