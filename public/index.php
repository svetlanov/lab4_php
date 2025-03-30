<?php

// Путь к файлу
$file = __DIR__ . '/../storage/books.txt';
// Чтение файла
$books = [];
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $books = array_map('json_decode', $lines);
}
// Последние 2 книги
$latestBooks = array_slice($books, -2);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Главная — Последние книги</title>
</head>
<body>

  <h1>Последние добавленные книги</h1>
  <a href="/public/book/create.php"> Добавить новую книгу</a>
  <br><a href="/public/book/index.php"> Посмотреть все книги</a>
  <hr>

  <?php if (empty($latestBooks)): ?>
    <p>Пока книг нет.</p>
  <?php else: ?>
    <?php foreach ($latestBooks as $book): ?>
      <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px;">
        <h2><?= htmlspecialchars($book->title) ?></h2>
        <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
        <p><strong>Жанр:</strong> <?= htmlspecialchars($book->genre) ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

</body>
</html>
