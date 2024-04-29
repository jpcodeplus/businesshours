<?php

use app\code\Converter;
use app\code\Helper;
use app\code\System;

// use Autoloader 
require_once __DIR__.'/../vendor/autoload.php';

// Hello World - Testausgabe
echo System::helloWorld();

// Laden des CSV Files und ausgabe des selbigen um die Feiertage verfügbar zu haben 

$holidayFile = System::readFile(__DIR__.'/data/holidays.csv');
$holidayArray = Converter::csvToArray($holidayFile);

Helper::dd($holidayArray);