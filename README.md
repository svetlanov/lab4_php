#  Лабораторная работа №4  
## Тема: Обработка и валидация форм в PHP  
**Проект:** Онлайн-библиотека книг

---

###  Цель работы

Освоить принципы:
- работы с HTML-формами в PHP,
- отправки данных на сервер,
- фильтрации и валидации данных,
- сохранения информации в файл в формате JSON,
- вывода данных с постраничной навигацией (пагинацией).

---

###  Структура проекта

```
project/
├── public/
│   ├── index.php
│   └── book/
│       ├── create.php
│       └── index.php
├── src/
│   ├── handlers/
│   │   └── save_book.php
│   ├── get_books.php
│   └── helpers.php
├── storage/
│   └── books.txt
└── README.md
```

---

###  Выполненные задания

####  Задание 1. Создание проекта
- Проект реализован в виде онлайн-библиотеки.
- Создана логичная структура каталогов.

<img width="425" alt="image" src="https://github.com/user-attachments/assets/030a54a3-4abb-4f73-b19f-3ac9a1bb88ca" />

####  Задание 2. Форма добавления книги
- Форма содержит:
  - название (`<input type="text">`)
  - жанр (`<select>`)
  - автор (`<input type="text">`)
  - описание (`<textarea>`)
  - теги (`<select multiple>`)
  - главы (динамическое добавление через JavaScript)
  - кнопка отправки
    
**Результат:**

  <img width="255" alt="image" src="https://github.com/user-attachments/assets/cfb9414c-d7cb-4645-9684-646f571525be" />

####  Задание 3. Обработка формы
- Данные фильтруются и валидируются в `helpers.php`.
- Ошибки отображаются под соответствующими полями.
- При успехе — данные сохраняются в `storage/books.txt` в формате JSON (одна строка — одна книга).
- Используются сессии для хранения ошибок и данных.

####  Задание 4. Отображение книг
- **public/index.php** — выводит 2 последних книги.
- **public/book/index.php** — отображает все книги с пагинацией (по 5 на страницу).
- Используется `GET`-параметр `page`.

**Результат public/index.php:**

<img width="389" alt="image" src="https://github.com/user-attachments/assets/fe0be0b1-64b7-43e3-affa-5cfbfaab4f90" />

**Результат public/book/index.php:**

<img width="326" alt="image" src="https://github.com/user-attachments/assets/d2d40add-45ea-461e-9813-7c381ec6b1cd" />

---

###  Дополнительно реализовано
-  `get_books.php` — подключаемый модуль для загрузки книг
-  Пагинация (`?page=2`, `?page=3`, ...)
-  Автоматическая фильтрация и защита от XSS
-  Содержимое `books.txt` содержит 26 сгенерированных книг

---

###  Как запустить проект

1. Убедиться, что установлен PHP.
2. Открыть терминал в корне проекта.
3. Запустить встроенный сервер:

   ```bash
   php -S localhost:8000 
   ```

4. Перейдити в браузере на `http://localhost:8000`

---

### Контрольные вопросы

- **Какие методы HTTP применяются для отправки данных формы?**  
  `GET` и `POST`. Для отправки данных формы обычно используется `POST`.

- **Что такое валидация и чем она отличается от фильтрации?**  
  - *Фильтрация* — это очистка данных (удаление пробелов, XSS и т.д.)  
  - *Валидация* — это проверка данных на корректность (например, поле не должно быть пустым).

- **Какие функции PHP используются для фильтрации данных?**  
  `htmlspecialchars()`, `trim()`, `filter_var()` и др.

---
 
