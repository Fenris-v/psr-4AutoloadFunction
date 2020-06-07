<?php

/**
 * Функция для регистрации классов и подключения необходимых файлов
 */
spl_autoload_register(
    function ($class) {
        // Префикс пространства имен
        $prefix = 'App\\';

        // Базовый каталог для префикса пространства имен
        $baseDir = __DIR__ . '/src/';

        // Использует ли класс префикс пространства имен?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // Нет, переходим к следующему зарегестрированному автоподгрузчику
            return;
        }

        // Получаем относительное имя класса
        $relativeClass = substr($class, $len);

        // Создаем имя файла
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        // Если файл существует, то подключаем его
        if (file_exists($file)) {
            /** @noinspection PhpIncludeInspection */
            require $file;
        }
    }
);
