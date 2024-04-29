<?php

namespace District5Tests\FormatterMocks;

class BasicDTOMock
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $title
    ) { }
}
