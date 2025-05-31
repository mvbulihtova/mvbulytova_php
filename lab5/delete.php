<?php require('header.php');?>
<?php
// Включить отображение ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Подключение к базе данных
$mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
if (!$mysqli) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Удаление записи, если передан id через GET
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $firstname = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT firstname FROM notes WHERE id=$id"))['firstname'];
    mysqli_query($mysqli, "DELETE FROM notes WHERE id=$id");
    echo "<p style='color:red;'>Запись с фамилией $firstname удалена</p>";
}

// Запрос на вывод оставшихся записей
$sql = "SELECT `id`, `firstname`, LEFT(`name`, 1) AS P, LEFT(`lastname`, 1) AS L FROM `notes` ORDER BY `firstname`";
$result = mysqli_query($mysqli, $sql);
if (!$result) {
    die("Ошибка запроса: " . mysqli_error($mysqli));
}

// Вывод ссылок на удаление
while ($row = mysqli_fetch_assoc($result)): ?>
    <a href="delete.php?id=<?= $row['id'] ?>">
        <?= htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['P']) . '.' . htmlspecialchars($row['L']) . '.' ?>
    </a><br>
<?php endwhile; ?>
<?php require('footer.php');?>