<?php
declare(strict_types=1);

namespace App\Tests\Domain\Mappers\NumberMapper;

use App\Domain\Mappers\NumberMapper\ValueInArrayMapper;
use PHPUnit\Framework\TestCase;

class ValueInArrayMapperTest extends TestCase
{
    private const VALUE_IN_ARRAY = 1;
    private const MAP_STRING = 'map_string';
    private const VALUES_ARRAY = [self::VALUE_IN_ARRAY];

    private ValueInArrayMapper $mapper;

    protected function setUp()
    {
        parent::setUp();

        $this->mapper = new ValueInArrayMapper(self::MAP_STRING, ...self::VALUES_ARRAY);
    }

    /**
     * @dataProvider mapDataProvider
     */
    public function testMap(int $number, ?string $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->mapper->map($number));
    }

    public function mapDataProvider()
    {
        return [
            'value_not_in_array' => [
                0, null
            ],
            'value_in_array' => [
                self::VALUE_IN_ARRAY, self::MAP_STRING
            ]
        ];
    }
}
