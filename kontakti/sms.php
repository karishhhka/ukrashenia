<?php
if(isset($_POST['submit'])){
    $to = "carinagridneva@yandex.ru"; // Адрес почты получателя
    $subject = "Сообщение с сайта";
    $message = "От: " . $_POST['name'] . "\n";
    $message .= "Комментарий: " . $_POST['comment'];
    $headers = "From: webmaster@example.com"; // Адрес отправителя

    if(mail($to, $subject, $message, $headers)){
        echo "Сообщение успешно отправлено.";
    } else{
        echo "Ошибка при отправке сообщения.";
    }
}
?>
<br>
<a href="http://localhost/ukrashenia/kontakti/index.html">Вернуться на главную страницу</a>


?>

