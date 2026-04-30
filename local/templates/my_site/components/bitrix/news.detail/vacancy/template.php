<div class="vacancy-detail">
<h1><?= $arResult["NAME"] ?></h1>
<div class="vacancy-meta">
    <p><b>Офис:</b> <?= $arResult["PROPERTIES"]["OFFICE"]["VALUE"] ?></p>
    <p><b>Город:</b> <?= $arResult["PROPERTIES"]["LOCATION"]["VALUE"] ?></p>
    <p class="salary"><b>Зарплата:</b> <?= $arResult["PROPERTIES"]["SALARY"]["VALUE"] ?></p>
</div>
<h3>Обязанности</h3>
<?php
$duties = (array)$arResult["PROPERTIES"]["DUTY"]["VALUE"];
?>
<ul class="duties">
    <?php foreach ($duties as $duty): ?>
        <li><?= htmlspecialchars($duty) ?></li>
    <?php endforeach; ?>
</ul>
<a class="back-link" href="/">На главную</a>
</div>
