<?php

require_once __DIR__ . '/../helpers.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Очищаем входные данные
    $data = [
        'title' => sanitize($_POST['title'] ?? ''),
        'genre' => sanitize($_POST['genre'] ?? ''),
        'author' => sanitize($_POST['author'] ?? ''),
        'description' => sanitize($_POST['description'] ?? ''),
        'tags' => $_POST['tags'] ?? [],
        'chapters' => array_filter($_POST['chapters'] ?? [], fn($c) => trim($c) !== '')
    ];

    // Валидация
    $errors = validateBookData($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../public/book/create.php');
        exit;
    }

    // Сохранение
    saveToFile(__DIR__ . '/../../storage/books.txt', $data);

    // Очистка старых данных
    unset($_SESSION['old'], $_SESSION['errors']);

    // Перенаправление
    header('Location: ../../public/index.php');
    exit;
}
