<?php

namespace DevSite;

use Bitrix\Main\Loader;

class LogHandler
{
    const LOG_CODE = "LOG";

    public static function handle(&$arFields)
    {
        if (empty($arFields["IBLOCK_ID"]) || empty($arFields["ID"])) {
            return;
        }

        Loader::includeModule("iblock");

        $iblock = \CIBlock::GetByID($arFields["IBLOCK_ID"])->Fetch();
        if (!$iblock) {
            return;
        }
        if ($iblock["CODE"] === self::LOG_CODE) {
            return;
        }

        $logIblock = \CIBlock::GetList([], ["CODE" => self::LOG_CODE])->Fetch();
        if (!$logIblock) {
            return;
        }

        $sectionId = self::getOrCreateSection($logIblock["ID"], $iblock);

        $path = self::getPath($arFields["IBLOCK_SECTION_ID"]);

        $elementName = $arFields["NAME"] ?? $arFields["ID"];

        $data = [
            "IBLOCK_ID" => $logIblock["ID"],
            "IBLOCK_SECTION_ID" => $sectionId,
            "NAME" => $arFields["ID"],
            "ACTIVE_FROM" => $arFields["DATE_CREATE"] ?? $arFields["TIMESTAMP_X"],
            "PREVIEW_TEXT" =>
                $iblock["NAME"] .
                " -> " .
                $path .
                " -> " .
                $elementName,

            "PREVIEW_TEXT_TYPE" => "text",
        ];

        $el = new \CIBlockElement;

        $existing = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_ID" => $logIblock["ID"],
                "NAME" => $arFields["ID"]
            ],
            false,
            false,
            ["ID"]
        )->Fetch();

        if ($existing) {
            $el->Update($existing["ID"], $data);
        } else {
            $el->Add($data);
        }
    }

    private static function getPath($sectionId)
    {
        if (!$sectionId) return "";

        $nav = \CIBlockSection::GetNavChain(false, $sectionId);

        $path = [];

        while ($item = $nav->Fetch()) {
            $path[] = $item["NAME"];
        }

        return implode(" -> ", $path);
    }

    private static function getOrCreateSection($logIblockId, $iblock)
    {
        $res = \CIBlockSection::GetList([], [
            "IBLOCK_ID" => $logIblockId,
            "CODE" => $iblock["CODE"]
        ]);

        if ($sec = $res->Fetch()) {
            return $sec["ID"];
        }

        $bs = new \CIBlockSection;

        return $bs->Add([
            "IBLOCK_ID" => $logIblockId,
            "NAME" => $iblock["NAME"],
            "CODE" => $iblock["CODE"]
        ]);
    }
}