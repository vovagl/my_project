<?php
namespace DevSite;

use Bitrix\Main\Loader;

class Agent
{
    public static function cleanLog()
    {
        if (!Loader::includeModule("iblock")) {
            return "\\DevSite\\Agent::cleanLog();";
        }

        $iblockId = 8; // LOG

        $res = \CIBlockElement::GetList(
            ["ID" => "DESC"], 
            ["IBLOCK_ID" => $iblockId],
            false,
            false,
            ["ID"]
        );

        $ids = [];

        while ($el = $res->Fetch()) {
            $ids[] = $el["ID"];
        }

        if (count($ids) <= 10) {
            return "\\DevSite\\Agent::cleanLog();";
        }

        $toDelete = array_slice($ids, 10);

        foreach ($toDelete as $id) {
            \CIBlockElement::Delete($id);
        }

        return "\\DevSite\\Agent::cleanLog();";
    }
}