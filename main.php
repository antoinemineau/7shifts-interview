<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Calculator;

$numbers = [
    "1,2",
    "1,2,5",
    "1\n,2,3",
    "1,\n2,4",
    "//;\n1;3;4",
    "//$\n1$2$3",
    "//@\n2@3@8",
    "//@\n2@3@8",
    "//***\n1***2***3",
];

foreach ($numbers as $number) {
    echo "===== START =====\r\n";
    echo "Number: " . $number . "\r\nResult: ";
    $calculator = new Calculator();
    $calculator->Add($number);
    echo "\r\n====== END ======\r\n";
}
