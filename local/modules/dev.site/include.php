<?php

\Bitrix\Main\Loader::registerAutoLoadClasses(
    "dev.site",
    [
        "DevSite\\LogHandler" => "lib/LogHandler.php",
        "DevSite\\Agent" => "lib/Agent.php",
    ]
);