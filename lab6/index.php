<!-- 1. По заходу на страницу запишите в сессию текст 'test'. 
Затем обновите страницу и выведите содержимое сессии на экран. -->

<?php
session_start();
if (!isset($_SESSION['text'])) {
    $_SESSION['text'] = 'test';
    echo "Текст записан в сессию. Обновите страницу.";
} else {
    echo "Содержимое сессии: " . $_SESSION['text'].'<BR><BR>';
}


// 3. Сделайте счетчик обновления страницы пользователем. 
// Данные храните в сессии. Скрипт должен выводить на экран количество обновлений. 
// При первом заходе на страницу он должен вывести сообщение о том, что вы еще не обновляли страницу.


if (!isset($_SESSION['refresh_count'])) {
    // Если пользователь зашел впервые
    $_SESSION['refresh_count'] = 0;
    echo "Вы ещё не обновляли эту страницу.";
} else {
    // Увеличиваем счётчик при каждом обновлении
    $_SESSION['refresh_count']++;
    echo "Вы обновили страницу {$_SESSION['refresh_count']} раз(а).".'<BR><BR>';
}


// 5. Запишите в сессию время захода пользователя на сайт. 
// При обновлении страницы выводите сколько секунд назад пользователь зашел на сайт.

if (!isset($_SESSION['login_time'])) {
    // Записываем текущее время при первом заходе
    $_SESSION['login_time'] = time();
    echo "Вы только что зашли на сайт.".'<BR><BR>';
} else {
    // Вычисляем разницу между текущим временем и временем входа
    $seconds = time() - $_SESSION['login_time'];
    echo "Вы зашли на сайт $seconds секунд назад.".'<BR><BR>';
}


// 6. Спросите у пользователя email с помощью формы. 
// Затем сделайте так, чтобы в другой форме (поля: имя, фамилия, пароль, email) 
// при ее открытии поле email было автоматически заполнено.

if (isset($_POST['step']) && $_POST['step'] === 'email') {
    $_SESSION['user_email'] = $_POST['email'] ?? '';
}

// Получаем email из сессии (если есть)
$email = $_SESSION['user_email'] ?? '';

// Если email ещё не введён — показываем первую форму
if (empty($email)): ?>
    <!-- Форма 1: запрос email -->
    <form method="post">
        <label>Введите email:</label>
        <input type="email" name="email" required>
        <input type="hidden" name="step" value="email">
        <button type="submit">Продолжить</button>
    </form>

<?php else: ?>
    <!-- Форма 2: регистрация с автоподставленным email -->
    <form method="post">
        <label>Имя:</label>
        <input type="text" name="firstname" required><br>

        <label>Фамилия:</label>
        <input type="text" name="lastname" required><br>

        <label>Пароль:</label>
        <input type="password" name="password" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>

        <button type="submit">Зарегистрироваться</button>
    </form>
<?php endif; ?>

<!-- 8. Удалите куку с именем test. -->
<?php
setcookie('test', '', time() - 3600);
echo "Кука 'test' удалена.".'<BR><BR>';

// 10. Спросите дату рождения пользователя. 
// При следующем заходе на сайт напишите сколько дней осталось до его дня рождения. 
// Если сегодня день рождения пользователя - поздравьте его!

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['birthdate'])) {
    // Сохраняем дату в формате YYYY-MM-DD
    setcookie('birthdate', $_POST['birthdate'], time() + (365 * 24 * 60 * 60)); // на 1 год
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Если кука уже есть
if (isset($_COOKIE['birthdate'])) {
    $today = new DateTime();
    $birthdate = new DateTime($_COOKIE['birthdate']);

    // День и месяц из даты рождения
    $nextBirthday = DateTime::createFromFormat('Y-m-d', $today->format('Y') . '-' . $birthdate->format('m-d'));

    // Если ДР уже прошёл в этом году — переносим на следующий
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }

    $interval = $today->diff($nextBirthday);
    $days = $interval->days;

    // Выводим сообщение
    if ($days === 0) {
        echo "🎉 С днём рождения! 🎉";
    } else {
        echo "До вашего дня рождения осталось $days дней.";
    }
} else {
    // Форма для ввода даты рождения
    echo '
    <form method="post">
        <label>Введите вашу дату рождения:</label>
        <input type="date" name="birthdate" required>
        <button type="submit">Сохранить</button>
    </form>';
}
?>