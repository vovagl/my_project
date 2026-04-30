
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->addExternalCss($templateFolder . "/style.css");
?>
<h1>Новости</h1> 
<div class="article-list">
    <?php foreach($arResult["ITEMS"] as $item): ?>
        <a class="article-item article-list__item" href="<?= $item["DETAIL_PAGE_URL"] ?>">            
            <div class="article-item__background">
                <?php if ($item["PREVIEW_PICTURE"]): ?>
                    <img src="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialchars($item["NAME"]) ?>">
                <?php else: ?>
                    <img src="/images/article-item-bg-1.jpg" alt="">
                <?php endif; ?>
            </div>
            <div class="article-item__wrapper">
                <div class="article-item__title">
                    <?= htmlspecialchars($item["NAME"]) ?>
                </div>

                <div class="article-item__content">
                    <small><?= $item["ACTIVE_FROM"] ?></small><br>
                    <?= $item["PREVIEW_TEXT"] ?>
                </div>
            </div>
        </a> 
    <?php endforeach; ?>
</div>