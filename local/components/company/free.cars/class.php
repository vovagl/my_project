<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Bitrix\Highloadblock as HL;

class FreeCarsComponent extends CBitrixComponent
{
    private $iblockCarsId = null;
    private $iblockCarModelsId = null;

    public function executeComponent()
    {
        global $USER;

        Loader::includeModule('iblock');
        Loader::includeModule('highloadblock');

        if (!$USER->IsAuthorized())
        {
            ShowError('Auth required');
            return;
        }

        $this->iblockCarsId = $this->getIBlockIdByCode('cars');
        $this->iblockCarModelsId = $this->getIBlockIdByCode('car_models');

        if (!$this->iblockCarsId || !$this->iblockCarModelsId)
        {
            ShowError('Инфоблоки не найдены');
            return;
        }

        $from = $this->parseDate($_GET['date_from'] ?? null);
        $to   = $this->parseDate($_GET['date_to'] ?? null);

        if (!$from || !$to)
        {
            ShowError('Wrong date format');
            return;
        }

        $this->arResult['CARS'] = $this->getAvailableCars(
            (int)$USER->GetID(),
            $from,
            $to
        );

        $this->includeComponentTemplate();
    }

    private function getIBlockIdByCode(string $code): ?int
    {
        $iblock = \CIBlock::GetList(
            [],
            ['CODE' => $code, 'CHECK_PERMISSIONS' => 'N']
        )->Fetch();

        return $iblock ? (int)$iblock['ID'] : null;
    }

    private function parseDate(?string $date): ?DateTime
    {
        if (!$date) return null;

        try {
            return new DateTime(
                (new \DateTime($date))->format('d.m.Y H:i:s'),
                'd.m.Y H:i:s'
            );
        } catch (\Exception $e) {
            return null;
        }
    }

    private function getAvailableCars(int $userId, DateTime $from, DateTime $to): array
    {
        $user = \CUser::GetByID($userId)->Fetch();

        if (!$user) return [];

        $allowedComfort = $this->getAllowedComfortByPosition((string)$user['UF_POSITION']);
        if (!$allowedComfort) return [];

        $busyCars = $this->getBusyCars($from, $to);
        $cars     = $this->getCars();

        $result = [];
        foreach ($cars as $car)
        {
            if (in_array($car['ID'], $busyCars, true)) continue;
            if ($car['COMFORT'] <= 0) continue;
            if (!in_array($car['COMFORT'], $allowedComfort, true)) continue;

            $result[] = $car;
        }

        return $result;
    }

    private function getCars(): array
    {
        $result = [];

        $res = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $this->iblockCarsId, 'ACTIVE' => 'Y'],
            false,
            false,
            ['ID', 'NAME']
        );

        while ($car = $res->Fetch())
        {
            $carId = (int)$car['ID'];

            
            $modelId = 0;
            $propModel = \CIBlockElement::GetProperty(
                $this->iblockCarsId,
                $carId,
                [],
                ['CODE' => 'MODEL']
            )->Fetch();

            if (!empty($propModel['VALUE']))
                $modelId = (int)$propModel['VALUE'];

            $modelName = '';
            $comfort   = 0;

            if ($modelId > 0)
            {
                $model = \CIBlockElement::GetByID($modelId)->Fetch();
                if ($model)
                {
                    $modelName = $model['NAME'];

                    $propComfort = \CIBlockElement::GetProperty(
                        $this->iblockCarModelsId,
                        $modelId,
                        [],
                        ['CODE' => 'COMFORT_CATEGORY']
                    )->Fetch();

                    if (!empty($propComfort['VALUE_ENUM']))
                        $comfort = (int)$propComfort['VALUE_ENUM'];
                }
            }

        
            $driverName = '';
            $propDriver = \CIBlockElement::GetProperty(
                $this->iblockCarsId,
                $carId,
                [],
                ['CODE' => 'DRIVER']
            )->Fetch();

            $driverId = !empty($propDriver['VALUE']) ? (int)$propDriver['VALUE'] : 0;
            if ($driverId)
            {
                $u = \CUser::GetByID($driverId)->Fetch();
                if ($u)
                    $driverName = trim($u['NAME'] . ' ' . $u['LAST_NAME']);
            }

            $result[] = [
                'ID'          => $carId,
                'NAME'        => $car['NAME'],
                'MODEL_NAME'  => $modelName,
                'COMFORT'     => $comfort,
                'DRIVER_NAME' => $driverName,
            ];
        }

        return $result;
    }

    private function getBusyCars(DateTime $from, DateTime $to): array
    {
        $entity = $this->getHL('CarBooking');
        if (!$entity) return [];

        $dataClass = $entity->getDataClass();
        $rows = $dataClass::getList([
            'select' => ['UF_CAR_ID'],
            'filter' => [
                '<=UF_DATE_FROM' => $to,
                '>=UF_DATE_TO'   => $from,
                '=UF_STATUS'     => 'ACTIVE'
            ]
        ]);

        $result = [];
        while ($row = $rows->fetch())
        {
            if (!empty($row['UF_CAR_ID']))
                $result[] = (int)$row['UF_CAR_ID'];
        }

        return array_values(array_unique($result));
    }

    private function getAllowedComfortByPosition(string $position): array
    {
        $entity = $this->getHL('PositionComfort');
        if (!$entity) return [];

        $dataClass = $entity->getDataClass();
        $rows = $dataClass::getList([
            'filter' => ['=UF_POSITION' => $position],
            'select' => ['UF_COMFORT_CATEGORY_ID']
        ]);

        $result = [];
        while ($row = $rows->fetch())
        {
            if (!empty($row['UF_COMFORT_CATEGORY_ID']))
                $result[] = (int)$row['UF_COMFORT_CATEGORY_ID'];
        }

        return array_values(array_unique($result));
    }
    
    private function getHL(string $name)
    {
        $hlblock = HL\HighloadBlockTable::getList([
            'filter' => ['=NAME' => $name]
        ])->fetch();

        if (!$hlblock) return null;

        return HL\HighloadBlockTable::compileEntity($hlblock);
    }
}