<?php


namespace App\Core\Shared\Domain;


use App\Core\Shared\Domain\Exception\CollectionKeyNotFoundException;
use App\Core\Shared\Domain\Exception\CollectionKeyUsedException;
use Countable;
use Iterator;

class Collection implements Countable, Iterator
{
    protected array $items;
    protected int $count;
    protected int $position;

    public function __construct(array $items = [])
    {
        $this->items = $items;
        $this->count = count($items);
        $this->position = 0;
    }

    public function addItem($obj, $key = null)
    {
        if (null == $key) {
            $this->items[] = $obj;
            ++$this->count;
        } else {
            if (isset($this->items[$key])) {
                throw new CollectionKeyUsedException("Key $key already in use.");
            } else {
                $this->items[$key] = $obj;
                ++$this->count;
            }
        }

        return $this;
    }

    /**
     * Adds item at beggining.
     *
     * @param mixed $obj
     *
     * @return Collection
     */
    public function unshift($obj): Collection
    {
        array_unshift($this->items, $obj);
        ++$this->count;

        return $this;
    }

    public function deleteItem($key): void
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
            --$this->count;
        } else {
            throw new CollectionKeyNotFoundException("Key '$key' not found.");
        }
    }

    public function clear(): void
    {
        $this->items = [];
        $this->count = 0;
        $this->position = 0;
    }

    public function getItem($key): mixed
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new CollectionKeyNotFoundException("Key '$key' not found.");
        }
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function length(): int
    {
        return count($this->items);
    }

    public function keyExists($key): bool
    {
        return isset($this->items[$key]);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function first(): mixed
    {
        if (count($this->items)) {
            return $this->items[0];
        }

        return null;
    }

    public function last(): mixed
    {
        if (count($this->items)) {
            return $this->items[count($this->items) - 1];
        }

        return null;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }
}
