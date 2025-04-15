<?php
header('Content-Type: text/html; charset=utf-8');
$headers = getallheaders();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW2Bulytova</title>
</head>

<body>
    <header>
        <img src="./img/polytech_logo_main_RGB.jpeg" alt="logo" class="logo"
        style="height: 50px;">
        <h1 style="color: dimgray;">Домашнее задание №2</h1>
    </header>
    <main>
        <label for="headers">Заголовки запроса:</label>
            <textarea id="headers" rows="10" cols="50" readonly>
                <?php foreach ($headers as $key => $value) { echo "$key: $value\n"; } ?>
            </textarea>
            <a href="hw2.php">Перейти на 1 страницу</a>
    </main>
    <footer>
        <p style="color: dimgray;">Выполнила: Булытова Мария</p>
    </footer>
</body>

</html>