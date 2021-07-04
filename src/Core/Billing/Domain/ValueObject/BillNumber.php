<?php


namespace App\Core\Billing\Domain\ValueObject;


use App\Core\Shared\Domain\ValueObject\AbstractStringValueObject;
use Assert\Assertion;

class BillNumber extends AbstractStringValueObject
{
    public const MAX_LENGTH = 20;

    public static function fromString(string $value): self
    {
        Assertion::notBlank($value);
        Assertion::maxLength($value, self::MAX_LENGTH);

        return new self($value);
    }
}