<?php

namespace App\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{

    /** @var NumberFormatter|MockObject $numberFormatter */
    private $numberFormatter;

    /**
     * @param int $index
     * @param float $argument
     * @param string $returnValue
     */
    private function addCase(int $index, float $argument, string $returnValue)
    {
        $this->numberFormatter->expects($this->at($index))
            ->method('format')
            ->with($argument)
            ->will($this->returnValue($returnValue));
    }

    public function testFormatCurrency()
    {
        $this->numberFormatter = $this->createMock(NumberFormatter::class);

        $this->addCase(0, 2835779, '2.84M');
        $this->addCase(1, 211.99, '211.99');
        $this->addCase(2, 2835779, '2.84M');
        $this->addCase(3, 211.99, '211.99');

        $moneyFormatter = new MoneyFormatter($this->numberFormatter);

        $this->assertEquals('2.84M €', $moneyFormatter->formatEur(2835779));
        $this->assertEquals('211.99 €', $moneyFormatter->formatEur(211.99));

        $this->assertEquals('$2.84M', $moneyFormatter->formatUsd(2835779));
        $this->assertEquals('$211.99', $moneyFormatter->formatUsd(211.99));
    }
}
