<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php foreach ($arResult['ITEMS'] as $iblockId => $items): ?>
    <div class="news-group">
        <h2>Инфоблок ID: <?= $iblockId ?></h2>

        <ul class="news-list">
            <?php foreach ($items as $item): ?>
                <li class="news-item">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                        <?= $item['NAME'] ?>
                    </a>
                    <p><?= $item['PREVIEW_TEXT'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>