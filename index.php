<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "template",
    array(
        "IBLOCK_ID" => 1,
        "NEWS_COUNT" => 20,
        "CACHE_TYPE" => "A",
    )
);
?>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:main.feedback",
    "",
    array(
        "USE_CAPTCHA" => "N",
        "EMAIL_TO" => "test@mail.com",
        "REQUIRED_FIELDS" => array("NAME", "EMAIL", "MESSAGE"),
        "OK_TEXT" => "Сообщение отправлено",
    )
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>