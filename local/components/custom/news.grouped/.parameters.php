<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "STRING",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока",
            "TYPE" => "STRING",
        ],
        "FILTER_NAME" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Имя фильтра",
            "TYPE" => "STRING",
            "DEFAULT" => ""
        ]
    ]
];