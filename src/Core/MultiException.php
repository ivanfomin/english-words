<?php

namespace App\Core;

class MultiException
    extends \Exception
    implements \Iterator
{
    protected $data = [];

    public function add($item)
    {
        $this->data[] = $item;
    }

    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        return null !== key($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }
}