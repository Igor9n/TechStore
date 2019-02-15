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

    public function arrayProvider()
    {
        return [
            [[], ['It must fails']]
        ];
    }
}
