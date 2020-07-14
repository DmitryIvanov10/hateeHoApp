<?php
declare(strict_types=1);

namespace App\Tests\Domain\Mappers\NumberMapper;

use App\Domain\Mappers\NumberMapper\DividerMapper;
use PHPUnit\Framework\TestCase;

class DividerMapperTest extends TestCase
{
    private const DIVIDER = 3;
    private const MAP_STRING = 'map_string';

    private DividerMapper $mapper;

    protected function setUp()
    {
        parent::setUp();

        $this->mapper = new DividerMapper(self::DIVIDER, self::MAP_STRING);
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
            'number_divided_with_reminder' => [
                5, null
            ],
            'number_divided_without_reminder' => [
                6, self::MAP_STRING
            ]
        ];
    }
}
