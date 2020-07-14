<?php
declare(strict_types=1);

namespace App\Domain\Mappers\NumberMapper;

interface NumberToStringMapperInterface
{
    public function map(int $number): ?string;
}
