<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require(__DIR__."/header.php");

$APPLICATION->SetTitle("Новости");

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "my_template",
    [
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => 1,
        "NEWS_COUNT" => 5,
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "CACHE_TYPE" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
    ]
);

require(__DIR__."/footer.php");