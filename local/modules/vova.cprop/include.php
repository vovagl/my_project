<?php

\Bitrix\Main\Loader::registerAutoLoadClasses(
    "vova.cprop",
    [

        "Vendor\\Cprop\\Event\\PropertyHandler"
            => "lib/Event/PropertyHandler.php",

        "Vendor\\Cprop\\Property\\HtmlType"
            => "lib/Property/HtmlType.php",

        "Vendor\\Cprop\\Property\\TextType"
            => "lib/Property/TextType.php",

        "Vendor\\Cprop\\Property\\TypeRegistry"
            => "lib/Property/TypeRegistry.php",

    ]
);