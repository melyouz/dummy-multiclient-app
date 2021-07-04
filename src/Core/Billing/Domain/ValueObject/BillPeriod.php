<?php


namespace App\Core\Billing\Domain\ValueObject;


use App\Core\Shared\Domain\ValueObject\AbstractStringValueObject;
use App\Core\Shared\Domain\ValueObject\ValueObjectInterface;
use Assert\Assertion;
use DateTimeImmutable;
use JsonSerializable;

class BillPeriod implements ValueObjectInterface
{
    private DateTimeImmutable $from;
    private DateTimeImmutable $to;

    private function __construct(DateTimeImmutable $from, DateTimeImmutable $to)
    {
        Assertion::lessThan($from->getTimestamp(), $to->getTimestamp());

        $this->from = $from;
        $this->to = $to;
    }

    public function from(): DateTimeImmutable
    {
        return $this->from;
    }

    public function to(): DateTimeImmutable
    {
        return $this->to;
    }

    public static function fromDates(DateTimeImmutable $from, DateTimeImmutable $to): self
    {
        return new self($from, $to);
    }

    public function sameValueAs(ValueObjectInterface $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value()
    {
        return sprintf('%s-%s-', $this->from->getTimestamp(), $this->to->getTimestamp());
    }

    public function __toString(): string
    {
        return $this->value();
    }
}