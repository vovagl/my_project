<?php

namespace Vendor\Cprop\Property;

class TypeRegistry
{
    public static function get($type)
    {
        $map = [

            "text" => TextType::class,

            "html" => HtmlType::class,

        ];

        return $map[$type] ?? null;
    }
}