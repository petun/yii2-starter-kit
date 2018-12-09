<?php
declare(strict_types=1);

namespace common\exception;

use Throwable;

/**
 * Class DomainException.
 *
 * @package common\exception
 */
class DomainException extends \DomainException implements DetailsExceptionInterface
{
    /**
     * @var array Detail info about exception
     */
    protected $details;

    /**
     * DomainException constructor.
     *
     * @param string $message
     * @param Throwable|null $previous
     * @param array $details
     */
    public function __construct(
        $message = '',
        Throwable $previous = null,
        array $details = []
    ) {
        $this->details = $details;

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param array $details
     *
     * @return DomainException
     */
    public static function createDefault(array $details): DomainException
    {
        return new self('Unable to save model', null, $details);
    }
}
