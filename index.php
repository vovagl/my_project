<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	".default",
    [
        "IBLOCK_ID" => 1,
        "IBLOCK_TYPE" => "news",
        "NEWS_COUNT" => 10,
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/",

        "SEF_URL_TEMPLATES" => [
            "news" => "",
            "section" => "#SECTION_CODE#/",
            "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
        ],

        "SET_TITLE" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600,
    ]
);
?>
<hr>
<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    ".default",
    [
        "WEB_FORM_ID" => 2,
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "?success=Y",
    ]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>