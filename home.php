<?php
session_start();
require_once("connection.php");
$query2 = "SELECT * FROM users";
$result2 = mysqli_query($con, $query2) or die ("Error : " . mysqli_error());
?>

<head>
    <meta charset="utf-8">
    <title>musfe</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
<header>
    <div class="container">
        <div class="row">
            <ul>
                <div class="left">
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                </div>

                <div class="right">
                    <li><a href="">6</a></li>
                    <li><a href="">7</a></li>
                    <li><a href="">8</a></li>
                    <li><a href="">9</a></li>
                    <li><a href="">10</a></li>
                </div>
            </ul>
        </div>
    </div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="container_box">
    <table id="myTable" class="table-bordered datatable">
        <thead>
        <tr>
            <th>name</th>
            <th>first_name</th>
            <th>avatar</th>
            <th>mail</th>
            <th>username</th>
            <th>role</th>
            <th>action</th>
        </tr>
        </thead>

        <tbody>

        <?php
        while ($row2 = mysqli_fetch_array($result2)) {
            ?>
            <tr>
                <td><?= $row2["name"] ?></td>
                <td><?= $row2["first_name"] ?></td>
                <td><?= $row2["avatar"] ?></td>
                <td><?= $row2["mail"] ?></td>
                <td><?= $row2["username"] ?></td>

                <td><?php
                    if ($row2["role"] == "0")
                        echo "Пользователь";
                    if ($row2["role"] == "1")
                        echo "Модератор";
                    if ($row2["role"] == "2")
                        echo "Админ";
                    ?>
                </td>
                <td>
                    <?php
                    echo "<a href=\"#modal-1" . $row2["id"] . "\" class=\"btn_ed\"><i class=\"entypo-pencil\"></i>Изенить </a>";
                    echo "
                        <div id=\"modal-1" . $row2["id"] . "\" class=\"modalDialog\" >
                            <div class=\"modal-dialog\">
                                <div class=\"modal-content\">
                                      <div class=\"modal-header\">
                                            <a href=\"#close\" title=\"Закрыть\" class=\"close\">&times;</a>
                                            <h4 class=\"modal-title\">Изменить пользователя</h4>
                                      </div>
                                     <div class=\"modal-body\">  
                                        <form action=\"edit.php\" method=\"post\">
                                            <input type=\"hidden\" value=\"" . $row2["id"] . "\" name=\"id\">
                                            <label>Фамилия</label>
                                            <input name=\"first_name\" type=\"text\" id=\"first_name\" value=\"" . $row2["first_name"] . "\" class=\"form-control input-lg\">
                                            <br>
                                            <label>Имя</label>
                                            <input name=\"name\" type=\"text\" value=\"" . $row2["name"] . "\" class=\"form-control input-lg\">
                                            <br>
                                            <label>Логин</label>
                                            <input name=\"username\" type=\"text\" value=\"" . $row2["username"] . "\" class=\"form-control input-lg\">
                                            <br>
                                            <label>Пароль</label>
                                            <input type=\"password\" name=\"password\" class=\"form-control input-lg\">
                                            <br>
                                            <label>Почта</label>
                                            <input name=\"mail\" type=\"email\" value=\"" . $row2["mail"] . "\" class=\"form-control input-lg\">
                                            <br>
                                            <select name=\"option\" class=\"form-control\" style='z-index: 9999'>
                                                <option value=\"0\" ";
                                                    if ($row2["role"] == "0") {
                                                        echo "selected";
                                                    }
                                                    echo ">User</option>
                                                    <option value=\"1\" ";
                                                    if ($row2["role"] == "1") {
                                                        echo "selected";
                                                    }
                                                    echo ">Moderator</option>
                                            </select>
                                            <br>
                                           <div class=\"modal-footer\">
                                                 <a href=\"#close\" title=\"Закрыть\" type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Закрыть</a>
                                                 <button class=\"button\" id=\"btn\" name=\"btn\">Изменить пользователя</button>
				                           </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    if ($row2["role"] !== "2") {
                        echo "<a href=\"#openModal" . $row2["id"] . "\" class=\"btn btn-danger btn-sm btn-icon icon-left\"><i class=\"entypo-pencil\"></i>Удалить</a>";
                    }
                    echo "
                        <div id=\"openModal" . $row2["id"] . "\" class=\"modalDialog\" >
                            <div class=\"modal-dialog\">
                                <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <a href=\"#close\" title=\"Закрыть\" class=\"close\">&times;</a>
                                            <h4 class=\"modal-title\">Удаление пользователя</h4>
                                        </div>
                                        <div class=\"modal-body\">
                                            <h3>Вы точно хотите удалить этого пользователя?</h3>
                                            <div class=\"modal-footer\">
                                                 <a href=\"delete.php?id=" . $row2["id"] . "\" title=\"Закрыть\" type=\"button\" class=\"btn-default\" data-dismiss=\"modal\">ДА</button>
                                                <a href=\"#close\" title=\"Закрыть\" type=\"button\" class=\"btn-default\" data-dismiss=\"modal\">Нет</a>
                                            </div>
                                        </div >
                                </div>
                            </div>
                        </div >";
                    ?>
                    <a href="#" class="btn btn-info btn-sm btn-icon icon-left">
                        <i class="entypo-info"></i>
                        Профиль
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <br/>

</div>
<div class="add_us">
    <a href="#modal-add" class="btn btn-primary">
        <i class="entypo-plus"></i>
        Добавить пользователя
    </a>
    <div id="modal-add" class="modalDialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#close" title="Закрыть" class="close">&times;</a>
                    <h4 class="modal-title">Новый пользователь</h4>
                </div>
                <div class="modal-body">
                    <form action="create.php" method="post">
                        <input type="hidden" name="id">
                        <label>Фамилия</label>
                        <input name="first_name" type="text" id="first_name" class="form-control input-lg">
                        <br>
                        <label>Имя</label>
                        <input name="name" type="text" class="form-control input-lg">
                        <br>
                        <label>Логин</label>
                        <input name="username" type="text" class="form-control input-lg">
                        <br>
                        <label>Пароль</label>
                        <input type="password" name="password" class="form-control input-lg">
                        <br>
                        <label>Почта</label>
                        <input name="mail" type="email" class="form-control input-lg">
                        <br>
                        <select name="option" class="form-control" style='z-index: 9999'>
                            <option value="0"> User</option>
                            <option value="1">Moderator</option>
                        </select>
                        <br>
                        <div class="modal-footer">
                            <a href="#close" title="Закрыть" type="button" class="btn btn-default"
                               data-dismiss="modal">Закрыть</a>
                            <button class="button" id="btn" name="btn">Добавить пользователя</button>
                            <!--                        <input type="submit" class="btn btn-info" name="button">-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#myTable td').dblclick(function () {
            if ($(this).attr('contenteditable') !== undefined) {
                $(this).removeAttr('contenteditable');
            } else {
                $(this).attr('contenteditable', '');
            }
            ;
        });
    </script>


</div>
</body>