<?php
session_start();
require_once("connection.php");

//$username = $_SESSION['session_username'];
//$query2 = "SELECT * FROM users WHERE username='" . $username . "'";
//$result2 = mysqli_query($con, $query2) or die ("Error : " . mysqli_error());
//$row2 = mysqli_fetch_assoc($result2);


//if (isset($_SESSION['session_username'])) {
    //$username = $_SESSION['session_username'];
    //if (isset($_POST["button"])) {
        $role = $_POST["option"];
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $name = htmlspecialchars($_POST['name']);
        $mail = rawurldecode(htmlspecialchars($_POST['mail']));
//        if ($password == $password_again) {
            $result = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '" . $username . "'");
            if (mysqli_fetch_row($result) > 0) {
                echo "<script>alert(\"Пользователь существует!\");</script>";
                echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/home.php\"</script>";
            } else {
                //$query = "INSERT INTO users (username, password, role)" . "VALUES('{$username}', md5('{$password}'), '{$role}');";
                $query = "INSERT INTO users (mail, first_name, name, username, password, role) VALUES ('" . $mail . "','" . $first_name . "','" . $name . "','" . $username . "', '" . md5($password) . "','" . $role . "')";
                mysqli_query($con, $query) or die ("Error : " . mysqli_error());
                echo "<script>alert(\"Пользователь добавлен!\");</script>";
                echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/home.php\"</script>";
            }
//        } else {
//            echo "<script>alert(\"Пароли не совпадают!\");</script>";
//            echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/home.php\"</script>";
//        }
//    } else {
//        echo "<script>alert(\"Вы не авторезированны!\");</script>";
//        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/index.php\"</script>";
//    }
//}
?>