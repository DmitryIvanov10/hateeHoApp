<?php
declare(strict_types=1);

namespace App\Domain\Mappers\NumberMapper;

class ValueInArrayMapper implements NumberToStringMapperInterface
{
    /**
     * @var int[]
     */
    private array $numberValues;
    private string $mapString;

    public function __construct(string $mapString, int ...$numberValues)
    {
        $this->numberValues = $numberValues;
        $this->mapString = $mapString;
    }

    /**
     * @inheritDoc
     */
    final public function map(int $number): ?string
    {
        return in_array($number, $this->numberValues) ? $this->mapString : null;
    }
}
