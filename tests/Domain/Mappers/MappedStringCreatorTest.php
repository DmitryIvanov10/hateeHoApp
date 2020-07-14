<?php
declare(strict_types=1);

namespace App\Tests\Domain\Mappers;

use App\Domain\Mappers\MappedStringCreator;
use App\Domain\Mappers\NumberMapper\NumberToStringMapperInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MappedStringCreatorTest extends TestCase
{
    private MappedStringCreator $stringCreator;

    protected function setUp()
    {
        parent::setUp();

        $this->stringCreator = new MappedStringCreator();
    }

    /**
     * @param array[] $mapperReturnValues
     * @dataProvider mapNumberToStringDataProvider
     */
    public function testMapNumbersToString(
        int $firstNumber,
        int $lastNumber,
        string $delimiter,
        string $expectedResult,
        array $mappersReturnValues = []
    ) {
        $mappers = [];

        foreach ($mappersReturnValues as $mapperReturnValues) {
            /** @var NumberToStringMapperInterface|MockObject $mapper */
            $mapper = $this->createMock(NumberToStringMapperInterface::class);
            $mapper
                ->expects($this->any())
                ->method('map')
                ->will($this->onConsecutiveCalls(...$mapperReturnValues));
            $mappers[] = $mapper;
        }

        $this->stringCreator->setMappers(...$mappers);

        $this->assertEquals(
            $expectedResult,
            $this->stringCreator->mapNumbersToString($firstNumber, $lastNumber, $delimiter)
        );
    }

    public function mapNumberToStringDataProvider()
    {
        return [
            'no_mappers_one_number' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => '',
                '1'
            ],
            'no_mappers_two_numbers_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '',
                '12'
            ],
            'no_mappers_two_numbers_not_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '--',
                '1--2'
            ],
            'one_mapper_one_number_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => '',
                'map1Val',
                [
                    ['map1Val']
                ]
            ],
            'one_mapper_one_number_not_empty_delimiter_value_not_mapped' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => 'asdf',
                '1',
                [
                    [null]
                ]
            ],
            'one_mapper_one_number_not_empty_delimiter_value_mapped' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => 'asdf',
                'map1Val',
                [
                    ['map1Val']
                ]
            ],
            'one_mapper_two_numbers_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '',
                'a2',
                [
                    ['a', null]
                ]
            ],
            'one_mapper_two_numbers_not_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => 'xxx',
                '1xxxb',
                [
                    [null, 'b']
                ]
            ],
            'two_mappers_one_number_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => '',
                'ab',
                [
                    ['a'],
                    ['b']
                ]
            ],
            'two_mappers_one_number_not_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 1,
                'delimiter' => 'cc',
                'ba',
                [
                    ['b'],
                    ['a']
                ]
            ],
            'two_mappers_two_numbers_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '',
                'abb',
                [
                    ['a', null],
                    ['b', 'b']
                ]
            ],
            'two_mappers_two_numbers_not_empty_delimiter' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '---',
                'a---ab',
                [
                    ['a', 'a'],
                    [null, 'b']
                ]
            ],
            'two_mappers_two_numbers_not_empty_delimiter_no_value_mapped' => [
                'first_number' => 1,
                'last_number' => 2,
                'delimiter' => '---',
                '1---2',
                [
                    [null, null],
                    [null, null]
                ]
            ],
            'mixed_cases' => [
                'first_number' => 1,
                'last_number' => 4,
                'delimiter' => '-x-',
                'ac-x-bcd-x-3-x-ac',
                [
                    ['a', null, null, 'a'],
                    [null, 'b', null, null],
                    ['c', 'c', null, 'c'],
                    [null, 'd', null, null]
                ]
            ]
        ];
    }
}
