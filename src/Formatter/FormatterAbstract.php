<?php

/**
 * District5 Formatter Library
 *
 * @author      District5 <hello@district5.co.uk>
 * @copyright   District5 <hello@district5.co.uk>
 * @link        https://www.district5.co.uk
 *
 * MIT LICENSE
 *
 *   Permission is hereby granted, free of charge, to any person obtaining
 *   a copy of this software and associated documentation files (the
 *   "Software"), to deal in the Software without restriction, including
 *   without limitation the rights to use, copy, modify, merge, publish,
 *   distribute, sublicense, and/or sell copies of the Software, and to
 *   permit persons to whom the Software is furnished to do so, subject to
 *   the following conditions:
 *
 *   The above copyright notice and this permission notice shall be
 *   included in all copies or substantial portions of the Software.
 *
 *   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *   NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *   LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *   OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *   WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace District5\Formatter;

/**
 * FormatterAbstract
 *
 * An abstract class for structuring formatting objects.
 */
abstract class FormatterAbstract
{
    /**
     * Formats multiple items
     *
     * @param mixed $items
     * @param array|null $options
     *
     * @return array
     */
    public static function formatMultiple(mixed $items, array $options = null): array
    {
        $formatted = [];

        foreach ($items as $item) {
            $formattedSingle = static::formatSingle($item, $options);
            if (count($formattedSingle) === 0) {
                continue;
            }

            $formatted[] = $formattedSingle;
        }

        return $formatted;
    }

    /**
     * Formats a single item.
     *
     * @param mixed $item
     * @param array|null $options
     *
     * @return array
     */
    abstract public static function formatSingle(mixed $item, array $options = null): array;

    /**
     * @param string $key
     * @param array|null $options
     * @param mixed $default
     *
     * @return mixed
     */
    protected static function getOption(string $key, array $options = null, mixed $default = false): mixed
    {
        if (null === $options || false === is_array($options) || false === array_key_exists($key, $options)) {
            return $default;
        }

        return $options[$key];
    }
}
