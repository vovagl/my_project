<?php

namespace Vendor\Cprop\Property;

class TextType
{
    public static function render($name, $value = "")
    {
        return '
            <input
                type="text"
                name="'.$name.'"
                value="'.htmlspecialcharsbx($value).'"
                style="width:100%;"
            >
        ';
    }
}