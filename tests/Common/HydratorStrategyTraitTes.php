<?php

namespace OpenStack\Test\Common;

use OpenStack\Common\HydratorStrategyTrait;
use OpenStack\Test\TestCase;

class HydratorStrategyTraitTest extends TestCase
{
    private $fixture;

    public function setUp()
    {
        $this->fixture = new Fixture();
    }

    public function test_it_hydrates()
    {
        $data = ['foo' => 1, 'bar' => 2, 'baz' => 3, 'boo' => 4];

        $this->fixture->hydrate($data);

        $this->assertEquals(1, $this->fixture->foo);
        $this->assertEquals(2, $this->fixture->getBar());
        $this->assertEquals(3, $this->fixture->getBaz());
    }

    public function test_it_hydrates_aliases()
    {
        $this->fixture->hydrate(['FOO!' => 1], ['FOO!' => 'foo']);

        $this->assertEquals(1, $this->fixture->foo);
    }
}

class Fixture
{
    public $foo;
    protected $bar;
    private $baz;

    use HydratorStrategyTrait;

    public function getBar() { return $this->bar; }
    public function getBaz() { return $this->baz; }
}