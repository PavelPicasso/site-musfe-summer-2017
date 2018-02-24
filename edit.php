<?php

session_start();
require_once("connection.php");


//$username = $_SESSION['session_username'];
//$query2 = "SELECT * FROM users WHERE username='" . $username . "'";
//$result2 = mysqli_query($con, $query2) or die ("Error : " . mysqli_error());
//$row2 = mysqli_fetch_assoc($result2);


//if (isset($_SESSION['session_username'])) {
//    $username = $_SESSION['session_username'];
//    if (isset($_POST["button"])) {
            $id = $_POST["id"];
            $role = $_POST["option"];
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $first_name = htmlspecialchars($_POST['first_name']);
            $name = htmlspecialchars($_POST['name']);
            $mail = rawurldecode(htmlspecialchars($_POST['mail']));
//        if ($password == $password_again) {
            $query = "UPDATE users SET first_name = '" . $first_name . "',name = '" . $name . "',username = '" . $username . "',password = md5('" . $password . "'),mail = '" . $mail . "',role = '" . $role . "' WHERE id = '" . $id . "'";
            mysqli_query($con, $query) or die ("Error : " . mysqli_error());
            echo "<script>alert(\"Пользователь изменен!\");</script>";
echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"//home.php\"</script>";
//        } else {
//            echo "<script>alert(\"Пароли не совпадают!\");</script>";
//            echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/index.php#contact\"</script>";
//        }
//    }
//} else {
//    echo "<script>alert(\"Вы не авторезированны!\");</script>";
//    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/reg.php\"</script>";
//}


?>