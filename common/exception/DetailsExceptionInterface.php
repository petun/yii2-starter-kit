<?php
declare(strict_types=1);

namespace common\exception;

/**
 * Исключение содержит массив с полезной информацией.
 *
 * @package common\exception
 */
interface DetailsExceptionInterface
{
    /**
     * @return array
     */
    public function getDetails(): array;
}
