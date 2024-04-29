<?php

namespace District5Tests\FormatterTests;

use District5Tests\FormatterMocks\BasicDTOMock;
use District5Tests\FormatterMocks\BasicFormatterMock;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    protected BasicDTOMock $basicDTOMock;
    public function setUp(): void
    {
        parent::setUp();

        $this->basicDTOMock = new BasicDTOMock('District', 'Five', 'Corp');
    }

    public function testSimpleReturn()
    {
        $formatted = BasicFormatterMock::formatSingle($this->basicDTOMock);

        $this->assertCount(2, $formatted);
        $this->assertTrue(isset($formatted['first_name']));
        $this->assertTrue(isset($formatted['last_name']));
        $this->assertEquals($this->basicDTOMock->firstName, $formatted['first_name']);
        $this->assertEquals($this->basicDTOMock->lastName, $formatted['last_name']);
    }

    public function testOptionalReturn()
    {
        $formatted = BasicFormatterMock::formatSingle(
            $this->basicDTOMock,
            [
                'showTitle' => true
            ]
        );

        $this->assertCount(3, $formatted);
        $this->assertTrue(isset($formatted['first_name']));
        $this->assertTrue(isset($formatted['last_name']));
        $this->assertTrue(isset($formatted['title']));
        $this->assertEquals($this->basicDTOMock->firstName, $formatted['first_name']);
        $this->assertEquals($this->basicDTOMock->lastName, $formatted['last_name']);
        $this->assertEquals($this->basicDTOMock->title, $formatted['title']);
    }

    public function testRejectedReturn()
    {
        $formatted = BasicFormatterMock::formatSingle(
            $this->basicDTOMock,
            [
                'showTitle' => false
            ]
        );

        $this->assertCount(2, $formatted);
        $this->assertTrue(isset($formatted['first_name']));
        $this->assertTrue(isset($formatted['last_name']));
        $this->assertFalse(isset($formatted['title']));
        $this->assertEquals($this->basicDTOMock->firstName, $formatted['first_name']);
        $this->assertEquals($this->basicDTOMock->lastName, $formatted['last_name']);
    }
}
