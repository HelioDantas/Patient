<?php

namespace App\Dto;

use ArrayAccess;
use Exception;

readonly class Dto implements ArrayAccess
{
    
    public function toArray()
    {
        return (array) $this;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            throw new Exception('Pass a property of the class');
        }

        if (!$this->offsetExists($offset)) {
            throw new Exception("{$offset} is not a property of the class");
        }

        $this->{$offset} = $value;
    }

    public function offsetExists($offset): bool
    {
        return property_exists($this, $offset);
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = null;
        }
    }

    public function offsetGet($offset): mixed
    {
        if ($this->offsetExists($offset)) {
            return $this->{$offset};
        }
        return null;
    }
}
