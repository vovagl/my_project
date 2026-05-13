<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\YandexDisk;

$config = require __DIR__ . '/config.php';
$token = $config['token'];

$disk = new YandexDisk($token);

if (!isset($_GET['path'])) {
    die('Нет пути файла');
}

$path = $_GET['path'];

try {
    $disk->delete($path);
    header("Location: index.php");
    exit;
} catch (Exception $e) {
    echo "Ошибка удаления: " . $e->getMessage();
}