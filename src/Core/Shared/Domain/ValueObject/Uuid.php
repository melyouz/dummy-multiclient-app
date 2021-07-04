<?php


namespace App\Core\Shared\Domain\ValueObject;


use Assert\Assertion;

abstract class Uuid extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        Assertion::notBlank($value);
        Assertion::uuid($value);

        parent::__construct($value);
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }
}