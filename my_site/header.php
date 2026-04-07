<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/style.css");?>
    
</head>
<body>

<?$APPLICATION->ShowPanel();?>

<header>
    <p>Мой первый сайт.</P>
    <!-- <h1><?$APPLICATION->ShowTitle()?></h1> -->
</header>

<main>