<?php

namespace Vendor\Cprop\Property;

use Bitrix\Main\Loader;
use CLightHTMLEditor;

class HtmlType
{
    public static function render(string $name, $value): string
    {
        if (!is_string($value))
        {
            $value = (string)$value;
        }

        ob_start();

        $editorId = uniqid('vendor_html_');

        if (Loader::includeModule("fileman"))
        {
            $LHE = new CLightHTMLEditor();

            $LHE->Show([
                'id' => $editorId,
                'inputName' => $name,
                'content' => $value,
                'width' => '100%',
                'height' => '250px',
                'bUseFileDialogs' => false,
                'bFloatingToolbar' => true,
                'autoResize' => true,
            ]);
        }
        else
        {
            ?>
            <textarea
                name="<?= htmlspecialcharsbx($name) ?>"
                style="width:100%;height:200px;"
            ><?= htmlspecialcharsbx($value) ?></textarea>
            <?php
        }

        return ob_get_clean();
    }
}