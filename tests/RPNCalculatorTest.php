<?php

namespace RPN\Test;

use PHPUnit\Framework\TestCase;
use RPN\RPNCalculator;

final class RPNCalculatorTest extends TestCase
{
    /** @var RPNCalculator */
    private $rpnCalculator;

    public function setUp()
    {
        $this->rpnCalculator = new RPNCalculator();
    }

    public function testCalculateSameNumber()
    {
        $this->assertEquals('3', $this->rpnCalculator->calculate('3'));
    }

    public function testCalculateAddittion()
    {
        $expression = '1 2 +';

        $this->assertEquals('3', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateSubstraction()
    {
        $expression = '1 2 -';

        $this->assertEquals('-1', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateMultiplication()
    {
        $expression = '2 3 *';

        $this->assertEquals('6', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateDivisionNotByZero()
    {
        $expression = '6 2 /';

        $this->assertEquals('3', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateDivisionByZero()
    {
        $expression = '6 0 /';

        $this->assertEquals('1', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateTwoOperation()
    {
        $expression = '4 2 + 3 -';

        $this->assertEquals('3', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateThreeOperation()
    {
        $expression = '3 5 8 * 7 + *';

        $this->assertEquals('141', $this->rpnCalculator->calculate($expression));
    }

    public function testCalculateComplexOperationWithSingleNumbers()
    {
        $expression = '7 2 - 3 4';

        $this->assertEquals('5 3 4', $this->rpnCalculator->calculate($expression));
    }
}
