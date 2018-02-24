<?php
session_start();
$types = array('image/gif', 'image/png', 'image/jpeg');

require_once("connection.php");
//if (isset($_SESSION["session_username"])) {
//     вывод "Session is set"; // в целях проверки
//    echo " <script language=\"JavaScript\">alert(1);</script>";
//    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/index.php\"</script>";
//} else {
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$password_again = htmlspecialchars($_POST['password_again']);
$first_name = htmlspecialchars($_POST['first_name']);
$name = htmlspecialchars($_POST['name']);
$mail = rawurldecode(htmlspecialchars($_POST['mail']));

$avatar = $_FILES['file']['name'];
$getMime = explode('.', $avatar);
$mime = "." . strtolower(end($getMime));
$profile = $username . $mime;
// Проверяем тип файла
if (!in_array($_FILES['file']['type'], $types)) {
    echo json_encode(array('done' => 'Запрещённый тип файла!', 'url' => ''));
} else {
    if ($password_again == $password) {
        $result = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '" . $username . "'");
        if (mysqli_fetch_row($result) > 0) {
            echo json_encode(array('done' => 'Пользователь существует!', 'url' => ""));
        } else {
            mysqli_query($con, "INSERT INTO users (avatar, mail, first_name, name, username, password) VALUES ('" . $profile . "','" . $mail . "','" . $first_name . "','" . $name . "','" . $username . "', '" . md5($password) . "')");
            $uploaddir = $_FILES['file']['tmp_name'];
            $uploadfile = 'images/avatar/' . $username . $mime;
            move_uploaded_file($uploaddir, $uploadfile);
            echo json_encode(array('done' => 'Вы зарегистрированы!', 'url' => '/home.php'));
        }
    } else {
        echo json_encode(array('done' => 'Пароли не совпадают!', 'url' => ''));
    }
}
//}
