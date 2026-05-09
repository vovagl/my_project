<?php
use Bitrix\Main\Loader;

\Bitrix\Main\Loader::includeModule("dev.site");

if (Loader::includeModule("vova.cprop"))
{
    \Vendor\Cprop\Event\PropertyHandler::init();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/modules/vova.cprop/lib/Property/UfType.php';
\AddEventHandler(
    "main",
    "OnUserTypeBuildList",
    [\Vendor\Cprop\Property\UfType::class, "GetUserTypeDescription"]
);


