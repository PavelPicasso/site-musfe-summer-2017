<?php
session_start();
require_once("connection.php");
?>
<head>
    <meta charset="utf-8">
    <title>musfe</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="image">
</div>
<div class="container">
    <form enctype="multipart/form-data" class="registration" method="post" id="registerSubmit" name="form">
        <h2>Регистрация</h2>

        <div class="step_1">
            <h3>Шаг_1</h3>
            <label>Фамилия</label> <br>
            <input class="input" name="first_name" type="text" id="first_name" required><br>
            <label>Имя</label> <br>
            <input class="input" name="name" type="text" id="name" required><br>

            <div class="avatar">
                <div id="preview">
                    <img style="border-radius: 100px;" src="http://placehold.it/170x170" alt="...">
                </div>

                <div class="change">
                    <div class="file-upload ">
                        <label>
                            <input type="file" id="the-photo-file-field" name="file" required>
                            <span>Выберите файл</span>
                        </label>
                    </div>
                </div>
            </div>

            <a onclick="view();" class="button step" name="button">Следующий шаг</a>
        </div>

        <div class="step_2">
            <h3>Шаг_2</h3>
            <label>Логин</label> <br>
            <input class="input" name="username" type="text" id="username" required><br>
            <label>Пароль</label> <br>
            <input class="input" name="password" type="password" id="password" required><br>
            <label>Повторите пароль</label> <br>
            <input class="input" name="password_again" type="password" id="password_again" required><br>
            <label>Почта</label> <br>
            <input class="input" name="mail" type="email" id="mail" required><br>
            <div class="btn">
                <a onclick="prev();" class="button" name="button">Предыдущий шаг</a>
                <button class="button" id="btn" name="btn">Завершить регистрацию</button>
            </div>
        </div>
    </form>
</div>
</body>
<script>
    $(document).ready(function () {
        $("#btn").on('click', function (e) {
            e.preventDefault();
            var file_data = $('#the-photo-file-field').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            var ser = $("#registerSubmit").serialize();
            var ar = ser.split('&');
            $.each(ar, function (item, index) {
                form_data.append(index.split('=')[0], index.split('=')[1]);
            });
            $.ajax({
                url: 'reg.php',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    location.href = document.location.origin + res.url;
                    alert(res.done);
                }
            });
        });
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            function renderImage(file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    the_url = event.target.result
                    $('#preview').html("<img style=\"width: 170px; height: 170px; border-radius: 200px; border: 1px solid white;\" src='" + the_url + "' />")
                }
                reader.readAsDataURL(file);
            }

            $("#the-photo-file-field").change(function () {
                renderImage(this.files[0])
            });
        } else {
            alert('The File APIs are not fully supported in this browser.');
        }
    });
</script>

<script>
    function view() {
        if ($(".step_1").css("display") == "block") {
            $(".step_1").css("display", "none");
        }

        if ($(".step_2").css("display") == "none") {
            $(".step_2").css("display", "block");
        }
    }
    function prev() {
        if ($(".step_2").css("display") == "block") {
            $(".step_2").css("display", "none");
        }

        if ($(".step_1").css("display") == "none") {
            $(".step_1").css("display", "block");
        }
    }
</script>
