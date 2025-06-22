<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Преобразование текста</title>
</head>

<body>
    <h1>Введите текст для преобразования:</h1>
    <form method="POST" action="index.php">
        <textarea name="text"></textarea><br><br>
        <input type="submit" value="Преобразовать">
    </form>

</body>

</html>
<?php
function redo(&$words) {
    for ($i = 1; $i < count($words); $i += 2) {
        $words[$i] = mb_strtoupper($words[$i]); 
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $words = explode(" ", $text);
    redo($words);
    $new_text = implode(" ", $words);
    echo "<h2>Преобразованный текст:</h2>";
    echo "<p>" . $new_text . "</p>";
} else {
    echo "<p>Ошибка: форма не была отправлена методом POST.</p>";
}

?>