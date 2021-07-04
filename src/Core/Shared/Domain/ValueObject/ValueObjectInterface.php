<?php


namespace App\Core\Shared\Domain\ValueObject;

interface ValueObjectInterface
{
    public function sameValueAs(ValueObjectInterface $other): bool;

    public function value();

    public function __toString(): string;
}