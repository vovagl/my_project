<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\YandexDisk;

$config = require __DIR__ . '/config.php';
$token = $config['token'];

$disk = new YandexDisk($token);

if (!isset($_FILES['file'])) {
    die('Файл не выбран');
}

$fileTmp = $_FILES['file']['tmp_name'];
$fileName = basename($_FILES['file']['name']);

try {
    $result = $disk->upload('/' . $fileName, $fileTmp);

    echo "Файл загружен успешно";
    header("Location: index.php");
    exit;

} catch (Exception $e) {
    echo "Ошибка загрузки: " . $e->getMessage();
}