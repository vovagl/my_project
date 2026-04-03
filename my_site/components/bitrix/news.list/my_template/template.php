<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="news-list">
    <?php foreach($arResult["ITEMS"] as $item): ?>
        <div class="news-item">
            <h2><?= htmlspecialchars($item["NAME"]) ?></h2>
            <p class="news-date"><?= $item["ACTIVE_FROM"] ?></p>
            <?php if ($item["PREVIEW_PICTURE"]): ?>
                <img src="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialchars($item["NAME"]) ?>" />
            <?php endif; ?>
            <p><?= $item["PREVIEW_TEXT"] ?></p>
        </div>
    <?php endforeach; ?>
</div>