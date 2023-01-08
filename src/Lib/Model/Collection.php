<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

class Collection extends \ArrayObject
{
    public function __construct(object|array $array = [], int $flags = 0, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    public function add(mixed $value): void
    {
        parent::append($value);
    }

    public function set(string $key, mixed $value): void
    {
        parent::offsetSet($key, $value);
    }

    public function get(string $key): mixed
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
