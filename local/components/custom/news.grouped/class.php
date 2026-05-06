<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class CustomNewsGroupedComponent extends CBitrixComponent
{
    protected function checkModules()
    {
        if (!Loader::includeModule("iblock")) {
            ShowError("Модуль инфоблоков не установлен");
            return false;
        }
        return true;
    }

    protected function validateParams()
{
    $errors = [];

    if (empty($this->arParams['IBLOCK_TYPE']) && empty($this->arParams['IBLOCK_ID'])) {
        $errors[] = "Не задан ни тип инфоблока, ни ID инфоблока";
    }

    if (!empty($this->arParams['IBLOCK_ID']) && !is_numeric($this->arParams['IBLOCK_ID'])) {
        $errors[] = "IBLOCK_ID должен быть числом";
    }

    foreach ($errors as $error) {
        ShowError($error);
    }

    return empty($errors);
}

    protected function getIblockIds()
    {
        if (!empty($this->arParams['IBLOCK_ID'])) {
            return [(int)$this->arParams['IBLOCK_ID']];
        }

        $ids = [];

        $filter = [
            "TYPE" => $this->arParams['IBLOCK_TYPE'],
            "ACTIVE" => "Y"
        ];

        $res = CIBlock::GetList([], $filter);

        while ($iblock = $res->Fetch()) {
            $ids[] = (int)$iblock['ID'];
        }

        return $ids;
    }
    protected function applyFilter(array $baseFilter)
    {
        if (!empty($this->arParams['FILTER_NAME'])) {
            $filterName = $this->arParams['FILTER_NAME'];

            if (isset($GLOBALS[$filterName]) && is_array($GLOBALS[$filterName])) {
                $baseFilter = array_merge($baseFilter, $GLOBALS[$filterName]);
            }
        }

        return $baseFilter;
    }
    protected function getItems(array $iblockIds)
    {
        $items = [];

        $filter = [
            "IBLOCK_ID" => $iblockIds,
            "ACTIVE" => "Y"
        ];

        $filter = $this->applyFilter($filter);

        $select = [
            "ID",
            "IBLOCK_ID",
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_PAGE_URL"
        ];

        $res = CIBlockElement::GetList([], $filter, false, false, $select);

        while ($item = $res->GetNext()) {
            $items[] = $item;
        }

        return $items;
    }
    protected function groupItems(array $items)
    {
        $grouped = [];

        foreach ($items as $item) {
            $grouped[$item['IBLOCK_ID']][] = $item;
        }

        return $grouped;
    }
    public function executeComponent()
    {
        if (!$this->checkModules()) {
            return;
        }

        if (!$this->validateParams()) {
            return;
        }

        $iblockIds = $this->getIblockIds();

        if (empty($iblockIds)) {
            ShowError("Инфоблоки не найдены");
            return;
        }

        $items = $this->getItems($iblockIds);

        $this->arResult['ITEMS'] = $this->groupItems($items);

        $this->includeComponentTemplate();
    }
}