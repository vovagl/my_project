<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule("iblock");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20;

$offset = ($page - 1) * $limit;

$res = CIBlockElement::GetList(
    ["ID" => "DESC"],
    ["IBLOCK_ID" => 7, "ACTIVE" => "Y"],
    false,
    false,
    ["ID", "NAME", "DETAIL_PAGE_URL"]
);

$items = [];
$i = 0;

while ($item = $res->GetNext()) {

    if ($i >= $offset && $i < $offset + $limit) {
        $items[] = [
            "id" => $item["ID"],
            "name" => $item["NAME"],
            "url" => "/?ELEMENT_ID=" . $item["ID"],
        ];
    }

    $i++;
}


header('Content-Type: application/json');

echo json_encode([
    "page" => $page,
    "items" => $items,
    "count" => count($items)
]);

