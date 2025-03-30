<?php
session_start();

// Получаем ошибки и старые данные из сессии
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавить книгу</title>
  <style>
    label { display: block; margin-top: 10px; }
    .chapter { margin-bottom: 5px; }
    .error { color: red; font-size: 0.9em; }
  </style>
</head>
<body>

  <h1>Добавить книгу</h1>

  <form action="../../src/handlers/save_book.php" method="POST">
    <!-- Название книги -->
    <label>Название книги:
      <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>">
      <?php if (!empty($errors['title'])): ?>
        <div class="error"><?= $errors['title'] ?></div>
      <?php endif; ?>
    </label>

    <!-- Жанр -->
    <label>Жанр:
      <select name="genre">
        <option value="">-- выберите жанр --</option>
        <?php
          $genres = ['роман', 'фэнтези', 'детектив', 'научная фантастика', 'биография'];
          foreach ($genres as $genre):
        ?>
          <option value="<?= $genre ?>" <?= (isset($old['genre']) && $old['genre'] === $genre) ? 'selected' : '' ?>>
            <?= ucfirst($genre) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (!empty($errors['genre'])): ?>
        <div class="error"><?= $errors['genre'] ?></div>
      <?php endif; ?>
    </label>

    <!-- Автор -->
    <label>Автор:
      <input type="text" name="author" value="<?= htmlspecialchars($old['author'] ?? '') ?>">
      <?php if (!empty($errors['author'])): ?>
        <div class="error"><?= $errors['author'] ?></div>
      <?php endif; ?>
    </label>

    <!-- Описание -->
    <label>Описание:
      <textarea name="description" rows="4"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
      <?php if (!empty($errors['description'])): ?>
        <div class="error"><?= $errors['description'] ?></div>
      <?php endif; ?>
    </label>

    <!-- Теги -->
    <label>Теги:
      <select name="tags[]" multiple>
        <?php
          $allTags = ['новинка', 'популярное', 'классика', 'саморазвитие'];
          $selectedTags = $old['tags'] ?? [];
          foreach ($allTags as $tag):
        ?>
          <option value="<?= $tag ?>" <?= in_array($tag, $selectedTags) ? 'selected' : '' ?>>
            <?= ucfirst($tag) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <!-- Главы -->
    <label>Главы книги:</label>
    <div id="chapters">
      <?php
        $chapters = $old['chapters'] ?? [''];
        foreach ($chapters as $i => $chapter):
      ?>
        <div class="chapter">
          <input type="text" name="chapters[]" value="<?= htmlspecialchars($chapter) ?>" placeholder="Глава <?= $i + 1 ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($errors['chapters'])): ?>
      <div class="error"><?= $errors['chapters'] ?></div>
    <?php endif; ?>

    <button type="button" onclick="addChapter()">Добавить главу</button>

    <br><br>
    <button type="submit">Сохранить книгу</button>
  </form>

  <script>
    function addChapter() {
      const chapters = document.querySelectorAll('.chapter').length + 1;
      const div = document.createElement('div');
      div.className = 'chapter';
      div.innerHTML = `<input type="text" name="chapters[]" placeholder="Глава ${chapters}">`;
      document.getElementById('chapters').appendChild(div);
    }
  </script>

</body>
</html>

<?php
// Очистим ошибки и старые данные после отображения
unset($_SESSION['errors'], $_SESSION['old']);
?>
