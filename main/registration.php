<?php
$conn = mysqli_connect('localhost', 'root', '', 'orders');

if ($conn == false) {
    echo 'Ошибка при подключении к бд';
    exit;
}

$email = $_POST['email'];
$login = $_POST['login'];
$pass = $_POST['pass'];
$doppass = $_POST['doppass'];
// проверка на пустые поля

if(empty($_POST['email']) || empty($_POST['login']) || empty($_POST['pass']) || empty($_POST['doppass'])){
    echo 'Заполните все поля';
    exit;
}

// провекла на  корректность введенных данных в пароле
if (!preg_match("#[a-zA-Z]#", $pass) || !preg_match("#\d#", $pass) || !preg_match("#\W#", $pass)) {
    echo "Пароль должен содержать буквы латинского алфавита, цифры и хотя бы один спецсимвол.";
    exit;
}
// провекла на  корректность введенных данных в почте
if (!preg_match("/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9_\-]+\.[a-zA-Z]{2,5}$/", $email)) {
    echo "Некорректный формат email адреса";
    exit;
}

if ($pass != $doppass) {
    echo 'пароли не совпадают';
    exit;
}

if (strlen($pass) < 6) {
    echo 'Увеличьте длину пароля';
    exit;
}


$hashed_password = password_hash($pass, PASSWORD_DEFAULT); // хеширование

$sql = $conn; 

// проверка логина на наличие в бд
$sq = $sql->prepare("SELECT * FROM `user` WHERE `login` = ?");
$sq->bind_param('s', $login);
$sq->execute();
$res = $sq->get_result();
if ($res->num_rows > 0) {
    echo 'Такой логин уже существует';
    exit;
}
// проверка почты на наличие в бд
$sqlsel = $sql->prepare("SELECT * FROM `user` WHERE `email` = ?");
$sqlsel->bind_param('s', $email);
$sqlsel->execute();
$resul = $sqlsel->get_result();
if ($resul->num_rows > 0) {
    echo 'Такой email уже существует';
    exit;
}
// запись данных в бд
$sqlinsert = $sql->prepare("INSERT INTO `user` (`login`, `email`, `password`) VALUES (?, ?, ?)");
$sqlinsert->bind_param('sss', $login, $email, $hashed_password);
$result = $sqlinsert->execute();

if ($result === false) {
    echo 'Ошибка';
    exit;
}

if ($result) {
    echo "Вы успешно зарегистрированы!";
 
}
?>
<br>
<a href=" http://localhost/ukrashenia/main/index.html">Вернуться на главную страницу</a>