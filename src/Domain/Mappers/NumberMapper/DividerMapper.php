<?php
declare(strict_types=1);

namespace App\Domain\Mappers\NumberMapper;

class DividerMapper implements NumberToStringMapperInterface
{
    private int $divider;
    private string $mapString;

    public function __construct(int $divider, string $mapString)
    {
        $this->divider = $divider;
        $this->mapString = $mapString;
    }

    /**
     * @inheritDoc
     */
    final public function map(int $number): ?string
    {
        return $this->numberDividerBy($number, $this->divider) ? $this->mapString : null;
    }

    private function numberDividerBy(int $number, int $divider): bool
    {
        return 0 === $number % $divider;
    }
}
