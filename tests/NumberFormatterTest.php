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

    /**
     * @return array
     */
    public function providerFormatNumber(): array
    {
        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['1 000', 999.9999],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12.00', 12],
            ['-124K', -123654.89]
        ];
    }

    /**
     * @dataProvider providerFormatNumber
     * @param string $expectedValue
     * @param float $givenValue
     */
    public function testFormatNumber(string $expectedValue, float $givenValue)
    {
        $this->assertEquals($expectedValue, $this->numberFormatter->format($givenValue));
    }
}
