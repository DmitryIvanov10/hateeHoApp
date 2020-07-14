<?php
declare(strict_types=1);

namespace App\Tests\Domain\Mappers\NumberMapper;

use App\Domain\Mappers\NumberMapper\BiggerThanMapper;
use PHPUnit\Framework\TestCase;

class BiggerThanMapperTest extends TestCase
{
    private const COMPARE_NUMBER = 0;
    private const MAP_STRING = 'map_string';

    private BiggerThanMapper $mapper;

    protected function setUp()
    {
        parent::setUp();

        $this->mapper = new BiggerThanMapper(self::COMPARE_NUMBER, self::MAP_STRING);
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
            'less_than' => [
                -1, null
            ],
            'equals' => [
                self::COMPARE_NUMBER, null
            ],
            'bigger_than' => [
                1, self::MAP_STRING
            ]
        ];
    }
}
