<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\YandexDisk;

$config = require __DIR__ . '/config.php';

$disk = new YandexDisk($config['token']);

$from = $_POST['path'] ?? null;
$newName = $_POST['new_name'] ?? null;

if (!$from || !$newName) {
    die("Нет данных");
}

try {
    $disk->rename($from, '/' . $newName);

    header("Location: index.php");
    exit;

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}