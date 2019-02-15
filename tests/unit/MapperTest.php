<?php

namespace tests\unit;

use Codeception\Test\Unit;
use Core\Mapper;

class MapperTest extends Unit
{
    /**
     * @var Mapper
     */
    protected $mapper;

    public function _before()
    {
        $this->mapper = new Mapper();
    }

    /**
     * @dataProvider arrayProvider
     * @param $value
     * @param $expected
     */
    public function testSimpleArray($value, $expected)
    {
        $result = $this->mapper->makeSimpleArray($value);

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider  exceptionProvider
     * @param $value
     */
    public function testSimpleArrayException($value)
    {
        $this->mapper->makeSimpleArray($value);
    }

    public function arrayProvider()
    {
        return [
            [[], []],
            [
                ['first' => ['one', 'two', 'three'], 'second' => ['four', 'five', 'six']],
                ['one', 'two', 'three', 'four', 'fails here', 'six']
            ]
        ];
    }

    public function exceptionProvider()
    {
        return [
            [['string' => ['first'], 'one']],
            [[213]]
        ];
    }
}
