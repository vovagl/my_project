<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent(
    "company:free.cars",
    ".default",
    []
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");