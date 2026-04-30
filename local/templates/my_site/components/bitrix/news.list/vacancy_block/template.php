
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule("iblock");

$page=isset($_GET['PAGEN_1']) ? (int)$_GET['PAGEN_1'] : 1; 
$itemsPerPage = 20; 

$totalCount = CIBlockElement::GetList(
    [],
    ["IBLOCK_ID" => 7, "ACTIVE" => "Y"],
    [],
    false,
    ["ID"]
);
$totalCount = (int)$totalCount;

$arNavParams = [
    "nPageSize" => $itemsPerPage,
    "iNumPage" => $page,
];

$res = CIBlockElement::GetList(
    ["ID" => "DESC"],
    ["IBLOCK_ID" => 7, "ACTIVE" => "Y"],
    false,
    $arNavParams,
    ["ID", "NAME"]
);
?>

<h1>Вакансии</h1>
<div id="vacancy-list"></div>
<button id="load-more" data-page="1">
    Показать ещё
</button>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const list = document.getElementById("vacancy-list");
    const btn = document.getElementById("load-more");

    function loadPage(page) {

        fetch("/local/ajax/vacancy.php?page=" + page)
            .then(res => res.json())
            .then(data => {

                if (!data.items || data.items.length === 0) {
                    btn.remove();
                    return;
                }

                data.items.forEach(item => {

                    const url = item.url && item.url !== ""
                        ? item.url
                        : "/vacancy/" + item.id + "/";

                    const card = document.createElement("div");
                    card.className = "vacancy-card";

                    card.innerHTML = `<a href="${url}">${item.name}</a>`;

                    list.appendChild(card);
                });

                btn.dataset.page = page;

                if (data.items.length < 20) {
                    btn.remove();
                }
            });
    }

    loadPage(1);
    btn.addEventListener("click", function () {
        let nextPage = parseInt(this.dataset.page) + 1;
        loadPage(nextPage);
    });

});
</script>


