<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обработка текста</title>
</head>

<body>
    <h1>Введите XVI, XVIII или XIX:</h1>
    <form method="POST" action="next.php">
        <input name="text"></input><br><br>
        <input type="submit" value="Преобразовать">
    </form>
    <br>

</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cent = $_POST["text"];
    if ($cent == "XVI") {
        echo "В XVI веке царствовал Иван Васильевич";
    } 
    else if ($cent == "XVII") {
        echo "В XVII веке царствовал Пётр Алексеевич";
    }
    else if ($cent == "XIX") {
        echo "В XIX веке царствовал Николай Павлович";
    }
} else {
    echo "<p>Ошибка: век не был отправлен методом POST.</p>";
}

?>