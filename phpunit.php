<?php
include ("vendor/autoload.php");
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stacks)
    {
        array_push($stacks, 'foo');
        $this->assertEquals('foo', $stacks[count($stacks)-1]);
        $this->assertNotEmpty($stacks);

        return $stacks;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack)
    {
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }
}
