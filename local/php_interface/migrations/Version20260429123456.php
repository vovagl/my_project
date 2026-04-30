<?php

namespace Sprint\Migration;

use Sprint\Migration\HelperManager;
use Sprint\Migration\Version;

class Version20260429123456 extends Version
{
    protected $description = "Вакансии + импорт CSV";

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        $helper = new HelperManager();

        $helper->Iblock()->addIblockTypeIfNotExists([
            'ID' => 'CONTENT',
            'SECTIONS' => 'N',
            'LANG' => [
                'ru' => ['NAME' => 'Контент']
            ]
        ]);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists([
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'CONTENT',
            'CODE' => 'VACANCIES',
            'NAME' => 'Вакансии'
        ]);

        $props = [
            ['NAME' => 'Комбинат', 'CODE' => 'OFFICE', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Местоположение', 'CODE' => 'LOCATION', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Требования', 'CODE' => 'REQUIRE', 'PROPERTY_TYPE' => 'S', 'MULTIPLE' => 'Y'],
            ['NAME' => 'Обязанности', 'CODE' => 'DUTY', 'PROPERTY_TYPE' => 'S', 'MULTIPLE' => 'Y'],
            ['NAME' => 'Условия', 'CODE' => 'CONDITIONS', 'PROPERTY_TYPE' => 'S', 'MULTIPLE' => 'Y'],
            ['NAME' => 'Зарплата', 'CODE' => 'SALARY', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Тип', 'CODE' => 'TYPE', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Занятость', 'CODE' => 'ACTIVITY', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'График', 'CODE' => 'SCHEDULE', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Сфера', 'CODE' => 'FIELD', 'PROPERTY_TYPE' => 'S'],
            ['NAME' => 'Email', 'CODE' => 'EMAIL', 'PROPERTY_TYPE' => 'S'],
        ];

        foreach ($props as $prop) {
            $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $prop);
        }

        $file = $_SERVER["DOCUMENT_ROOT"] . "/local/parser/vacancy.csv";

        if (!file_exists($file)) {
            throw new \Exception("CSV NOT FOUND: " . $file);
        }

        $handle = fopen($file, "r");

        fgetcsv($handle, 0, ",");

        $el = new \CIBlockElement;

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            $res = $el->Add([
                "IBLOCK_ID" => $iIBlockID,
                "NAME" => trim($row[3]),
                "ACTIVE" => "Y",
                "PROPERTY_VALUES" => [
                    "OFFICE" => $row[1],
                    "LOCATION" => $row[2],
                    "REQUIRE" => array_filter(explode(";", $row[4])),
                    "DUTY" => array_filter(explode(";", $row[5])),
                    "CONDITIONS" => array_filter(explode(";", $row[6])),
                    "SALARY" => $row[7],
                    "TYPE" => $row[8],
                    "ACTIVITY" => $row[9],
                    "SCHEDULE" => $row[10],
                    "FIELD" => $row[11],
                    "EMAIL" => $row[12],
                ]
            ]);

            if (!$res) {
                throw new \Exception($el->LAST_ERROR);
            }
        }

        fclose($handle);
    }

    public function down()
    {
        $helper = new HelperManager();
        $helper->Iblock()->deleteIblockIfExists('VACANCIES', 'CONTENT');
    }
}