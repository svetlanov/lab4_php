<?php

function sanitize(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function validateBookData(array $data): array {
    $errors = [];

    if (empty($data['title'])) {
        $errors['title'] = 'Введите название книги';
    }

    if (empty($data['genre'])) {
        $errors['genre'] = 'Выберите жанр';
    }

    if (empty($data['author'])) {
        $errors['author'] = 'Введите имя автора';
    }

    if (empty($data['description'])) {
        $errors['description'] = 'Введите описание';
    }

    if (empty($data['chapters'])) {
        $errors['chapters'] = 'Добавьте хотя бы одну главу';
    }

    return $errors;
}

function saveToFile(string $filename, array $data): void {
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $json . PHP_EOL, FILE_APPEND);
}
