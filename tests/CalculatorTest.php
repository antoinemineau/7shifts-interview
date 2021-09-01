<?php

declare(strict_types=1);

namespace App\Tests;

use App\Calculator;
use PHPUnit\Framework\TestCase;

use function is_int;

final class CalculatorTest extends TestCase
{
    public function testEmptyAndType() : void
    {
        $calculator = new Calculator();
        $this->assertEmpty($calculator->Add(""));

        $calculator = new Calculator();
        $this->assertTrue(is_int($calculator->Add("")));

        $calculator = new Calculator();
        $this->assertTrue(is_int($calculator->Add("1,2")));
    }

    public function testSimpleCalculator() : void
    {
        $calculator = new Calculator();
        $this->assertEquals(3, $calculator->Add("1,2"));

        $calculator = new Calculator();
        $this->assertEquals(8, $calculator->Add("1,2,5"));
    }

    public function testNewLine() : void
    {
        $calculator = new Calculator();
        $this->assertEquals(6, $calculator->Add("1\n,2,3"));
    }

    public function testLargeNumberIgnored() : void
    {
        $calculator = new Calculator();
        $this->assertEquals(2, $calculator->Add("2,1001"));
    }

    public function testDelimiterBigLength() : void
    {
        $calculator = new Calculator();
        $this->assertEquals(6, $calculator->Add("//***\n1***2***3"));
    }
}
