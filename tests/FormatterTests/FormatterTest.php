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
    }
}
