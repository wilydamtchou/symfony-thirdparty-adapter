<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse;

class ReferenceApiResponseCollection extends \ArrayObject
{
    public function add(ReferenceApiResponse $value): void
    {
        parent::append($value);
    }

    public function set(string $key, ReferenceApiResponse $value): void
    {
        parent::offsetSet($key, $value);
    }

    public function get(string $key): ReferenceApiResponse
    {
        return $this->cast(parent::offsetGet($key));
    }

    public function first(): ReferenceApiResponse
    {
        return $this->get(0);
    }

    public function __construct(object|array $array = [], int $flags = 0, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    public function cast($instance): ReferenceApiResponse
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen(ReferenceApiResponse::class),
            ReferenceApiResponse::class,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
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
