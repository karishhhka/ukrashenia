<?php
session_start(); // Убедитесь, что сессия начата

// Подключение к базе данных
$servername = "localhost";
$username = "root"; // Ваше имя пользователя для базы данных
$password = ""; // Ваш пароль для базы данных
$dbname = "orders"; // Имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка, существует ли переменная сессии для логина и email
if(isset($_SESSION['login']) && isset($_SESSION['email'])) {
    $user['login'] = $_SESSION['login'];
    $user['email'] = $_SESSION['email'];

    // Получение данных о заказах из базы данных
    $sql = "SELECT order_status, date_of_creation, product_type FROM orders WHERE email = '".$user['email']."'";
    $result = $conn->query($sql);

    // Инициализация переменных для хранения информации о заказах
    $order_status = '';
    $date_of_creation = '';
    $product_type = '';

    if ($result->num_rows > 0) {
        // Сохранение данных первого заказа в переменные
        $orders = $result->fetch_assoc();
        $order_status = $orders['order_status'];
        $date_of_creation = $orders['date_of_creation'];
        $product_type = $orders['product_type'];
    } else {
        echo "У вас нет заказов";
    }
} else {
    // Если сессионные переменные не установлены, перенаправляем на страницу авторизации
    header("Location: http://localhost/ukrashenia/main/index.html");
    exit;
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>jewels&radiance</title>
</head>
<body class="body" style="background-image: url(../public/img/Group\ 12.png);">
    <div class="container">
        <header>
        <div class="first">
                <div class="first__text">
                    <p>г. Лениногорск, ул.Абвгдежзийк, д. 1, кв. 2</p>
                    <p>+79687824989</p>
                </div>
                <img class="first__logo" src="../public/img/image 35 (1).png" alt="">
                <img id="open-reg-modal" class="first__profile" src="../public/img/Vector.png" alt="">
                <div id="reg-modal" class="modal">
                 <div class="modal-content">
                     <span  id="close" class="close">&times;</span>
                       <h2 class="modal_avtor">Регистрация</h2>
                     <form action="registration.php" method="post">
                       <input class="input__form" type="text" placeholder="Логин:" name="login"> <br>
                     <input class="input__form" type="text" placeholder="Почта:" name="email"><br>
                     <input class="input__form" type="password" placeholder="Пароль:" name="pass"><br>
                     <input class="input__form" type="password" placeholder="Подтверждение пароля:" name="doppass"><br>
                     <button class="modal__batton" type="submit" id="signIn">Регистрация</button>
                     </form>
                   <button id="open-login-modal" class="open-login-modal">Уже есть аккаунт? Войдите</button>
                 </div>
               </div>
               
               <div id="login-modal" class="modal">
                 <div class="modal-content">
                     <span id="closeTwo" class="close">&times;</span>
                     <h2 class="modal_avtor">Авторизация</h2>
                     <form action="avtoriz.php" method="post">
                       <input class="input__form" type="text" placeholder="Логин:" name="log"> <br>
                     <input class="input__form" type="password" placeholder="Пароль:" name="password"><br>
                     <button class="modal__batton" id="signIn">Вход</button>
                     </form>
                   <button id="open-inReg-modal" class="open-inReg-modal">Нет аккаунта? Зарегестрируйтесь</button>
                 </div>
               </div>
             </div>
            <div class="two">
                 <div class="two__href">
                  <a class="two__href__link" href="../main/index.html">О мастерской</a>
                    <a class="two__href__link" href="../katalog/index.html">Каталог</a>
                    <a class="two__href__link" href="../garantii/index.html">Гарантии</a>
                    <a class="two__href__link" href="../kakzakaz/index.html">Как заказать</a>
                    <a class="two__href__link" href="../kontakti/index.html">Контакты</a>
                 </div>
                 <hr class="two__line">
            </div>
        </header>
    </div>
    <div class="container">
      <div class="lichkab">
            <div class="lichkab__two">
                <h1 class="lichkab__two__zag">Личный кабинет</h1>
                <div class="lichkab__two__profile">
                <p class="lichkab__two__profile__one">Личные данные</p>
                <img class="img"  src="../public/img/Male User.png" alt="" srcset="">
                <p  class="lichkab__two__profile__two"><?php echo $user['login']?></p>
                <p  class="lichkab__two__profile__three"><?php echo $user['email'] ?></p>
            </div>
            </div>
            <div class="lichkab__three">
         <h2 class="lichkab__three__text">Информация по заказу</h2>
         <div class="lichkab__three__info" >
    <p class="lichkab__three__info__text">Статус закакза:</p>
    <p class="lichkab__three__info__text" ><?php echo htmlspecialchars($order_status);?></p>
</div>
<div class="lichkab__three__info" >
    <p class="lichkab__three__info__text">Дата добавления закакза:</p>
    <p class="lichkab__three__info__text" ><?php echo htmlspecialchars($date_of_creation); ?></p>
</div>
<div class="lichkab__three__info" >
    <p class="lichkab__three__info__text">Тип изделия:</p>
    <p class="lichkab__three__info__text" ><?php echo htmlspecialchars($product_type); ?></p>
</div>
       </div>
      </div>
    </div>
    <footer>
        <div class="container">
            <div class="foot">
                <img class="foot__img" src="../public/img/Group 13.png" alt="">
                <div class="foot__text">
                 <p class="foot__text__el">г. Лениногорск, ул.Абвгдежзийк, д. 1, кв. 2</p>
                 <p class="foot__text__el">Публичная оферта</p>
                 <p class="foot__text__el">+79687824989</p>
                </div>
                <div class="foot__icons">
                     <img class="foot__icons__img" src="../public/img/WhatsApp.png" alt="">
                     <img class="foot__icons__img"  src="../public/img/Group 8.png" alt="">
                     <img class="foot__icons__img"  src="../public/img/Telegram App.png" alt="">
                </div>
        </div>
    </footer>
    <script type="module" src="../modalwindow.js"></script>
</body>
</html>