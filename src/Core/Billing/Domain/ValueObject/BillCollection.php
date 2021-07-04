<?php


namespace App\Core\Billing\Domain\ValueObject;

use App\Core\Billing\Domain\Model\Bill;
use App\Core\Shared\Domain\Collection;
use InvalidArgumentException;

class BillCollection extends Collection
{
    /** @var Bill[] */
    protected array $items;

    public function __construct(array $items = [])
    {
        array_walk($items, [$this, 'itemGuard']);

        parent::__construct($items);
    }

    public function addItem($obj, $key = null)
    {
        $this->itemGuard($obj);

        return parent::addItem($obj, $key);
    }

    private function itemGuard($item): void
    {
        if (!$item instanceof Bill) {
            throw new InvalidArgumentException(sprintf('Items must be of type: %s', Bill::class));
        }
    }
}