<?php

use Bitrix\Main\ModuleManager;

class vova_cprop extends CModule
{
    public $MODULE_ID = "vova.cprop";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME = "CProp Module";
    public $MODULE_DESCRIPTION = "Complex properties";

    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . "/version.php";

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}