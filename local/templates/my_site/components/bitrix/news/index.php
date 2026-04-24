
<?php
echo $_SERVER["REQUEST_URI"];
$APPLICATION->IncludeComponent(
    "bitrix:news",
    ".default",
    [
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => 1,
        "NEWS_COUNT" => 10,
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/news/",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",
        "CHECK_DATES" => "Y",
        "SEF_URL_TEMPLATES" => [
            "news" => "",
            "section" => "#SECTION_CODE#/",
            "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
        ],

        "ADD_SECTIONS_CHAIN" => "Y",      
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600,
        "SET_TITLE" => "Y",
    ]
);
?>