<?php

namespace Vendor\Cprop\Property;

use Bitrix\Main\Loader;

class UfType
{
    public static function GetUserTypeDescription()
    {
        return [
            "USER_TYPE_ID" => "vendor_cprop_uf",
            "CLASS_NAME"   => __CLASS__,
            "DESCRIPTION"  => "Vendor Complex UF (HTML + Text)",
            "BASE_TYPE" => "string",
            "GetEditFormHTML"      => [__CLASS__, "GetEditFormHTML"],
            "GetAdminListViewHTML" => [__CLASS__, "GetAdminListViewHTML"],
            "GetDBColumnType"      => [__CLASS__, "GetDBColumnType"],
            "ConvertToDB"   => [__CLASS__, "ConvertToDB"],
            "ConvertFromDB" => [__CLASS__, "ConvertFromDB"],
        ];
    }

    public static function GetEditFormHTML($arUserField, $arHtmlControl)
    {
        $value = $arHtmlControl["VALUE"];

        $data = [
            "TITLE" => "",
            "TEXT"  => ""
        ];

        if (!empty($value))
        {
            $decoded = json_decode($value, true);
            if (is_array($decoded))
            {
                $data = array_merge($data, $decoded);
            }
        }

        $name = $arHtmlControl["NAME"];

        ob_start();
        ?>

        <div>

            <input
                type="text"
                name="<?= htmlspecialcharsbx($name) ?>[TITLE]"
                value="<?= htmlspecialcharsbx($data["TITLE"]) ?>"
                style="width:100%;margin-bottom:8px;"
                placeholder="Заголовок"
            >

            <?php if (Loader::includeModule("fileman")): ?>

                <?php
                $LHE = new \CLightHTMLEditor();
                $LHE->Show([
                    'id' => 'vendor_uf_' . $arUserField['ID'],
                    'inputName' => $name . '[TEXT]',
                    'content' => $data["TEXT"],
                    'width' => '100%',
                    'height' => '200px',
                    'bUseFileDialogs' => false,
                    'bFloatingToolbar' => true,
                ]);
                ?>

            <?php else: ?>

                <textarea
                    name="<?= htmlspecialcharsbx($name) ?>[TEXT]"
                    style="width:100%;height:150px;"
                ><?= htmlspecialcharsbx($data["TEXT"]) ?></textarea>

            <?php endif; ?>

        </div>

        <?php
        return ob_get_clean();
    }

    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        $value = json_decode($arHtmlControl["VALUE"], true);

        if (!is_array($value))
        {
            return "";
        }

        return htmlspecialcharsbx($value["TITLE"] ?? "");
    }

    public static function ConvertToDB($arUserField, $value)
    {
        if (is_array($value))
        {
            return json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        return $value;
    }

    public static function ConvertFromDB($arUserField, $value)
    {
        return $value;
    }

    public static function GetDBColumnType($arUserField)
    {
        return "text";
    }
}