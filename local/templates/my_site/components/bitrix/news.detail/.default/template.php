<?php $arResult["LIST_PAGE_URL"] = ""; ?>
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="news-detail">

    <h1><?=($arResult["NAME"]) ?></h1>

    <div class="news-date">
        <?= $arResult["ACTIVE_FROM"] ?>
    </div> 

    <?php if (!empty($arResult["DETAIL_PICTURE"])): ?>
        <div class="news-image">
            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="">
        </div>
    <?php endif; ?>

    <div class="news-text">
        <?= $arResult["DETAIL_TEXT"] ?>
    </div> 
    <!-- <a href="/news/" class="back-link">← Назад к списку</a> -->
</div>
