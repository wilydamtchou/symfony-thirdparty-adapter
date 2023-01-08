<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option;

class OptionEntityCollection extends \ArrayObject
{
    public function __construct(object|array $array = [], int $flags = 0, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    public function add(Option $value): void
    {
        parent::append($value);
    }

    public function set(string $key, Option $value): void
    {
        parent::offsetSet($key, $value);
    }

    public function get(string $key): Option
    {
        return parent::offsetGet($key);
    }

    public function exists(string $key): bool
    {
        return parent::offsetExists($key);
    }

    public function count(): int
    {
        return parent::count();
    }

    public function all(): array
    {
        return parent::getArrayCopy();
    }
}
