<?php


namespace App\Core\Billing\Domain\ValueObject;


use App\Core\Shared\Domain\ValueObject\AbstractDecimalValueObject;
use Assert\Assertion;

class BillTaxPercent extends AbstractDecimalValueObject
{
    public static function fromNumber(float|int $value): self
    {
        Assertion::greaterOrEqualThan(0);

        return new self((float)$value);
    }
}