<?php
header('Content-Type: text/html; charset=utf-8');
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
        <form id="feedbackForm" method="POST" action="https://httpbin.org/post">
            <label for="fullname">ФИО:</label>
            <input type="text" id="fullname" name="fullname" required>
    
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" required>
    
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" required>
    
            <label for="dob">Дата рождения:</label>
            <input type="date" id="dob" name="dob" required>
    
            <label for="company">Название компании:</label>
            <input type="text" id="company" name="company">
    
            <label for="message">Комментарий:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">Отправить</button>
        </form>
        <a href="hw2.1.php">Перейти на 2 страницу</a>
    </main>
    <footer>
        <p style="color: dimgray;">Выполнила: Булытова Мария</p>
    </footer>
</body>

</html>