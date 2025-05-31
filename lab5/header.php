<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Notebook</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
    <div class="text-center mt-5">
        <a href="/php/mvbulytova_php/lab5/index.php?elem=menu" class="bn <?=($_GET['elem'] ?? '') === 'menu' ? 'active' : ''?>">Главное меню</a>
        <a href="/php/mvbulytova_php/lab5/index.php?elem=add" class="bn <?=($_GET['elem'] ?? '') === 'add' ? 'active' : ''?>">Добавить запись</a>
        <a href="/php/mvbulytova_php/lab5/delete.php" class="bn <?=($_GET['elem'] ?? '') === 'delete' ? 'active' : ''?>">Удалить запись</a>
    </div>
    </header>
    <main>
        <div class="container mt-3">
