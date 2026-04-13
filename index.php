
<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
require($_SERVER["DOCUMENT_ROOT"]."/my_project/bitrix/header.php");
?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ?> 
<!-- <h1>Новости банка</h1> -->
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "template",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "news",
        "NEWS_COUNT" => "20",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "SET_TITLE" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
    )
);
?>

<!-- <h1>Вакансии</h1>
 
// $APPLICATION->IncludeComponent(
//     "bitrix:news.list",
//     "template",
//     Array(
//         "IBLOCK_ID" => "2",
//         "IBLOCK_TYPE" => "vacancies",
//         "NEWS_COUNT" => "20",
//         "DISPLAY_PICTURE" => "Y",
//         "DISPLAY_PREVIEW_TEXT" => "Y",
//         "SET_TITLE" => "N",
//         "SORT_BY1" => "ACTIVE_FROM",
//         "SORT_ORDER1" => "DESC",
//         "CACHE_TYPE" => "A",
//         "CACHE_TIME" => "36000000",
//     )
//); 
-->

<?php
require($_SERVER["DOCUMENT_ROOT"]."/my_project/bitrix/footer.php");
?>