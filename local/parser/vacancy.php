<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("iblock");

$IBLOCK_ID = 7;

$file = $_SERVER['DOCUMENT_ROOT'] . "/local/parser/vacancy.csv";

if (!file_exists($file)) {
    die("CSV not found");
}

$handle = fopen($file, "r");

fgetcsv($handle, 0, ",");

$el = new CIBlockElement();

$ok = 0;
$fail = 0;

while (($data = fgetcsv($handle, 0, ",")) !== false) {

    $name = trim($data[3] ?? '');

    if ($name === '') {
        $fail++;
        continue;
    }

    $id = $el->Add([
        "IBLOCK_ID" => $IBLOCK_ID,
        "NAME"      => $name,
        "ACTIVE"    => "Y",
    ]);

    if (!$id) {
        echo "ADD ERROR: " . $el->LAST_ERROR . PHP_EOL;
        $fail++;
        continue;
    }

    $PROP = [
        "OFFICE"     => trim($data[1] ?? ''),
        "LOCATION"   => trim($data[2] ?? ''),
        "SALARY"     => trim($data[7] ?? ''),
        "REQUIRE"    => trim($data[4] ?? ''),
        "DUTY"       => trim($data[5] ?? ''),
        "CONDITIONS" => trim($data[6] ?? ''),
        "ACTIVITY"   => trim($data[9] ?? ''),
        "SCHEDULE"   => trim($data[10] ?? ''),
        "FIELD"      => trim($data[11] ?? ''),
        "EMAIL"      => trim($data[12] ?? ''),
    ];

    $PROP = array_filter($PROP, fn($v) => $v !== '' && $v !== null);

    CIBlockElement::SetPropertyValuesEx($id, $IBLOCK_ID, $PROP);

    $ok++;
}

fclose($handle);

echo "DONE\n";
echo "OK: $ok\n";
echo "FAIL: $fail\n";




