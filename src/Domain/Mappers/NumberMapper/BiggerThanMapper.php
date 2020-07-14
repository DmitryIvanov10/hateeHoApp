<?php
declare(strict_types=1);

namespace App\Domain\Mappers\NumberMapper;

/**
 * An abstract ComparisonMapper may be created from which all comparison mappers may extend like this one
 */
class BiggerThanMapper implements NumberToStringMapperInterface
{
    private int $compareNumber;
    private string $mapString;

    public function __construct(int $compareNumber, string $mapString)
    {
        $this->compareNumber = $compareNumber;
        $this->mapString = $mapString;
    }

    /**
     * @inheritDoc
     */
    final public function map(int $number): ?string
    {
        return $number > $this->compareNumber ? $this->mapString : null;
    }
}
