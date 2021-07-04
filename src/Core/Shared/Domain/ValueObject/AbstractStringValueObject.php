<?php


namespace App\Core\Shared\Domain\ValueObject;

abstract class AbstractStringValueObject implements ValueObjectInterface
{
    protected const MAX_LENGTH = 255;

    protected string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public abstract static function fromString(string $value): self;

    public function sameValueAs(ValueObjectInterface $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}