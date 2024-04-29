<?php

namespace District5Tests\FormatterMocks;

use District5\Formatter\FormatterAbstract;

class BasicFormatterMock extends FormatterAbstract
{

    /**
     * @param BasicDTOMock $item
     * @param array|null $options
     * @return array
     */
    public static function formatSingle(mixed $item, array $options = null): array
    {
        /** @var BasicDTOMock $item */

        $payload = [
            'first_name' => $item->firstName,
            'last_name' => $item->lastName
        ];

        if (false !== static::getOption('showTitle', $options, false)) {
            $payload['title'] = $item->title;
        }

        return $payload;
    }
}
