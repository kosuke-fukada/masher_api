<?php
declare(strict_types=1);

namespace App\ValueObjects\Foundation;

abstract class StringValueObject
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @param string $value
     */
    abstract public function __construct(string $value);

    /**
     * @param string $value
     * @return void
     */
    abstract protected function validate(string $value): void;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
