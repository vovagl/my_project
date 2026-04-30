<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "news_block",
    [
        "IBLOCK_ID" => 1,
        "IBLOCK_TYPE" => "news",
        "SEF_URL_TEMPLATES" => [
            "news" => "",
            "section" => "#SECTION_CODE#/",
            "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
        ],
        "ACTIVE" => "Y",
        "NEWS_COUNT" => 10,
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600,
    ]
);

$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    ".default",
    [
        "WEB_FORM_ID" => 2,
    ]
);

$elementId = (int)$_GET['ELEMENT_ID'];

if ($elementId > 0) {

$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "vacancy",
    [
        "IBLOCK_ID" => 7,
        "ELEMENT_ID" => $elementId,
        "FIELD_CODE" => ["NAME"],
        "PROPERTY_CODE" => [
            "LOCATION",
             "OFFICE",
            "SALARY_VALUE",
            "REQUIRE",
            "DUTY",
            "CONDITIONS",
            "OFFICE",
            "ACTIVITY",
            "FIELD",
            "TYPE",
            "SCHEDULE"
        ],
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600
    ]
);
} else {
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "vacancy_block",
        [
            "IBLOCK_ID" => 7,
            "IBLOCK_TYPE" => "CONTENT",
            "NEWS_COUNT" => 20,
            "SORT_BY1" => "ID",
            "SORT_ORDER1" => "DESC",
            "FIELD_CODE" => ["NAME"],
            "PROPERTY_CODE" => [
                "LOCATION",
                 "OFFICE",
                "SALARY_VALUE",
                "REQUIRE",
                "DUTY",
                "CONDITIONS",
                "OFFICE",
                "ACTIVITY",
                "FIELD",
                "TYPE",
                "SCHEDULE"
            ],
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => 3600,
            
            "CHECK_DATES" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
        ]
    );
}    

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
