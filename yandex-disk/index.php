<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\YandexDisk;

$config = require __DIR__ . '/config.php';
$token = $config['token'];


$disk = new YandexDisk($token);

$data = $disk->listFiles('/');

$items = $data['_embedded']['items'] ?? [];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Яндекс Диск CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Яндекс Диск CRUD</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input  class="btn" type="file" name="file" required>
        <button type="submit">Загрузить</button>
    </form>

    <h3>Файлы:</h3>

    <table>
        <tr>
            <th>Имя</th>
            <th>Размер</th>
            <th>Действия</th>
        </tr>

        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <?php if ($item['type'] === 'file'): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= round($item['size'] / 1024, 2) ?> KB</td>
                        <td>
                            <a href="<?= $item['file'] ?>" target="_blank">Скачать</a>
                            |
                            <a href="delete.php?path=<?= urlencode($item['path']) ?>"
                               onclick="return confirm('Удалить файл?')">
                                Удалить
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Файлов нет</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>