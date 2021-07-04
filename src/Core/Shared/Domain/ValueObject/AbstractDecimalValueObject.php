<?php


namespace App\Core\Shared\Domain\ValueObject;


abstract class AbstractDecimalValueObject implements ValueObjectInterface
{
    protected float $value;

    protected function __construct(float $value)
    {
        $this->value = $value;
    }

    public abstract static function fromNumber(int|float $value): self;

    public function sameValueAs(ValueObjectInterface $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return number_format($this->value, 2, ',', ' ');
    }
}