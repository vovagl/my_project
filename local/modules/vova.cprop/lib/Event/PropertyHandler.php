<?php

namespace Vendor\Cprop\Event;

use Vendor\Cprop\Property\TypeRegistry;

class PropertyHandler
{
    public static function init()
    {
       \Bitrix\Main\Localization\Loc::loadMessages(__FILE__); 
        \AddEventHandler(
            "iblock",
            "OnIBlockPropertyBuildList",
            [__CLASS__, "GetUserTypeDescription"]
        );
    }

    public static function GetUserTypeDescription()
    {
        \Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
        return [
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "vendor_cprop",
            "DESCRIPTION" => \Bitrix\Main\Localization\Loc::getMessage("VENDOR_CPROP_PROPERTY_NAME"),

            "GetPropertyFieldHtml"
                => [__CLASS__, "GetPropertyFieldHtml"],

            "ConvertToDB"
                => [__CLASS__, "ConvertToDB"],

            "ConvertFromDB"
                => [__CLASS__, "ConvertFromDB"],
        ];
    }

    public static function GetPropertyFieldHtml(
        $property,
        $value,
        $controlName
    )
    {
        $data = [];

        if (!empty($value["VALUE"]))
        {
            $data = json_decode($value["VALUE"], true);
        }

        $fields = [
            [
                "code" => "TITLE",
                "type" => "text",
                "label" => "Заголовок",
            ],
            [
                "code" => "TEXT",
                "type" => "html",
                "label" => "Текст",
            ],
        ];

        ob_start();

        echo '<div style="padding:10px;border:1px solid #ccc">';

        foreach ($fields as $field)
        {
            $typeClass = TypeRegistry::get($field["type"]);

            if (!$typeClass)
            {
                continue;
            }

            echo '<div style="margin-bottom:15px;">';

            echo '<div style="margin-bottom:5px;font-weight:bold;">';
            echo $field["label"];
            echo '</div>';

            echo $typeClass::render(
                $controlName["VALUE"].'['.$field["code"].']',
                $data[$field["code"]] ?? ''
            );

            echo '</div>';
        }

        echo '</div>';

        return ob_get_clean();
    }

    public static function ConvertToDB($property, $value)
    {
        if (is_array($value["VALUE"]))
        {
            $value["VALUE"] = json_encode(
                $value["VALUE"],
                JSON_UNESCAPED_UNICODE
            );
        }

        return $value;
    }

    public static function ConvertFromDB($property, $value)
    {
        return $value;
    }
}