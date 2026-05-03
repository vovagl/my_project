<?php

use Bitrix\Main\ModuleManager;

class dev_site extends CModule
{
    public $MODULE_ID = "dev.site";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME = "Тренировочный модуль";
    public $PARTNER_NAME = "dev";

    public function __construct()
    {
        include __DIR__ . "/version.php";

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallEvents();
        $this->InstallAgents();
    }

    public function DoUninstall()
    {
        $this->UnInstallEvents();
        $this->UnInstallAgents();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }


    public function InstallEvents()
    {
        RegisterModuleDependences(
            "iblock",
            "OnAfterIBlockElementAdd",
            $this->MODULE_ID,
            "\\DevSite\\LogHandler",
            "handle"
        );

        RegisterModuleDependences(
            "iblock",
            "OnAfterIBlockElementUpdate",
            $this->MODULE_ID,
            "\\DevSite\\LogHandler",
            "handle"
        );
    }

    public function UnInstallEvents()
    {
        UnRegisterModuleDependences(
            "iblock",
            "OnAfterIBlockElementAdd",
            $this->MODULE_ID,
            "\\DevSite\\LogHandler",
            "handle"
        );

        UnRegisterModuleDependences(
            "iblock",
            "OnAfterIBlockElementUpdate",
            $this->MODULE_ID,
            "\\DevSite\\LogHandler",
            "handle"
        );
    }


    public function InstallAgents()
    {
        \CAgent::RemoveModuleAgents($this->MODULE_ID);

        \CAgent::AddAgent(
            "\\DevSite\\Agent::cleanLog();",
            $this->MODULE_ID,
            "N",
            3600,
            "",
            "Y"
        );
    }

    public function UnInstallAgents()
    {
        \CAgent::RemoveModuleAgents($this->MODULE_ID);
    }
}