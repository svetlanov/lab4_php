<?php
include_once('../../src/handlers/get_books.php');
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;


$books = get_books($page);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Все книги</title>
  <style>
    .book {
      border: 1px solid #aaa;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  <h1>Список всех книг</h1>
  <a href="create.php">➕ Добавить книгу</a>
  <a href="../index.php">🏠 На главную</a>
  <hr>

  <?php if (empty($books)): ?>
    <p>Книг пока нет.</p>
  <?php else: ?>
    <?php foreach ($books as $book): ?>
      <div class="book">
        <h2><?= htmlspecialchars($book->title) ?></h2>
        <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
        <p><strong>Жанр:</strong> <?= htmlspecialchars($book->genre) ?></p>
        <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($book->description)) ?></p>
        <p><strong>Теги:</strong> <?= implode(', ', $book->tags ?? []) ?></p>
        <p><strong>Главы:</strong></p>
        <ul>
          <?php foreach ($book->chapters ?? [] as $chapter): ?>
            <li><?= htmlspecialchars($chapter) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
    <div>
        <?php if ($page > 1) { ?>
          <a href="?page=<?= $page-1 ?>">Предыдущая страница</a>
        <?php } ?>
        <?php if (count($books) === 5) {?>
        <a href="?page=<?= $page+1 ?>">Следующая страница</a>
        <?php } ?>
      </div>
  <?php endif; ?>

</body>
</html>
