<?php

namespace App\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{

    /**
     * @var NumberFormatter $numberFormatter
     */
    private $numberFormatter;

    public function setUp()
    {
        $this->numberFormatter = new NumberFormatter();
    }

    public function testMillionFormatting()
    {
        $this->assertEquals('2.84M', $this->numberFormatter->format(2835779));
        $this->assertEquals('1.00M', $this->numberFormatter->format(999500));
    }

    public function testHundredsThousands()
    {
        $this->assertEquals('535K', $this->numberFormatter->format(535216));
        $this->assertEquals('100K', $this->numberFormatter->format(99950));
    }

    public function testThousands()
    {
        $this->assertEquals('27 534', $this->numberFormatter->format(27533.78));
        $this->assertEquals('1 000', $this->numberFormatter->format(999.9999));
    }

    public function testDefault()
    {
        $this->assertEquals('533.10', $this->numberFormatter->format( 533.1));
        $this->assertEquals('66.67', $this->numberFormatter->format(66.6666));
        $this->assertEquals('12.00', $this->numberFormatter->format(12));
    }
    
    public function testNegative()
    {
        $this->assertEquals('-124K', $this->numberFormatter->format(-123654.89));
    }
}
