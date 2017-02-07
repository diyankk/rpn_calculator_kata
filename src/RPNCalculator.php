<?php

namespace RPN;

final class RPNCalculator
{
    private static $operators = ['+', '-', '*', '/'];

    public function calculate(string $expression): string
    {
        $elements = explode(' ', $expression);
        $index    = 0;

        do {
            $element = $elements[$index];

            if ($this->isOperator($element)) {
                $firstOperand  = (int) $elements[$index - 2];
                $secondOperand = (int) $elements[$index - 1];

                $operationResult = (string) $this->applyOperation(
                    $firstOperand,
                    $secondOperand,
                    $element
                );

                $elements = array_merge(
                    array_slice($elements, 0, $index - 2),
                    [$operationResult],
                    array_slice($elements, $index + 1)
                );

                $index = 0;
            }
        } while (++$index < count($elements));

        return implode(' ', $elements);
    }

    private function isOperator(string $element): bool
    {
        return in_array($element, self::$operators);
    }

    private function applyOperation(int $firstOperand, int $secondOperand, string $operation): int
    {
        switch ($operation) {
            case '+':
                return $firstOperand + $secondOperand;
            case '-':
                return $firstOperand - $secondOperand;
            case '*':
                return $firstOperand * $secondOperand;
            case '/':
                return 0 === $secondOperand ? 1 : (int) ($firstOperand / $secondOperand);
        }
    }
}
