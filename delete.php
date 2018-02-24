<?php

session_start();
require("connection.php");

$username = $_SESSION['session_username'];
$query2 = "SELECT * FROM users WHERE username='".$username."'";
$result2 = mysqli_query($con, $query2) or die ("Error : " . mysqli_error());
$row2 = mysqli_fetch_assoc($result2);


//if (isset($_SESSION['session_username'])) {
    $username = $_SESSION['session_username'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM users WHERE id = '".$id."'";
        mysqli_query($con, $query) or die ("Error : " . mysqli_error());
        echo "<script>alert(\"Пользователь удален!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/home.php\"</script>";
    } else {
        echo "<script>alert(\"Нельзя удалить пользователя!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"//home.php\"</script>";
    }

//} else {
//    echo "<script>alert(\"Вы не авторезированны!\");</script>";
//    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/index.php\"</script>";
//}

?>

