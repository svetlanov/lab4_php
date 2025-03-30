<?php
function get_books($page = 1, $books_per_page = 5) {
    $file = __DIR__ . '/../../storage/books.txt';
    $books = [];
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $books = array_map('json_decode', $lines);
    }

    $start_position = 0;
    if ($page > 1) {
        $start_position = ($page - 1) * 5;
    }

    return array_slice($books, $start_position, $books_per_page);
}



