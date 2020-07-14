<?php
declare(strict_types=1);

namespace App\Domain\Mappers;

use App\Domain\Mappers\NumberMapper\NumberToStringMapperInterface;

class MappedStringCreator
{
    /**
     * @var NumberToStringMapperInterface[]
     */
    private array $mappers = [];

    /**
     * Some functionality may be added to add and clear mappers
     */
    final public function setMappers(NumberToStringMapperInterface ...$mappers): void
    {
        $this->mappers = $mappers;
    }

    final public function mapNumbersToString(
        int $firstNumber,
        int $lastNumber,
        string $delimiter
    ): string {
        $result = '';

        while ($firstNumber <= $lastNumber) {
            $result .= $this->getMappedNumber($firstNumber) . $delimiter;
            $firstNumber++;
        }

        return $delimiter ? substr($result, 0, -strlen($delimiter)) : $result;
    }

    private function getMappedNumber(int $number): string
    {
        $numberResult = '';

        foreach ($this->mappers as $mapper) {
            $numberResult .= $mapper->map($number) ?? '';
        }

        return $numberResult ?: (string)$number;
    }
}
