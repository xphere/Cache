<?php

/*
 * This file is part of the Berny\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Berny\Cache\Storage\ArrayAccess;

use Berny\Cache\ItemInterface;

class Item implements ItemInterface
{
    private $key;
    private $array;

    public function __construct($key, \ArrayAccess $array)
    {
        $this->key = $key;
        $this->array = $array;
    }

    public function get()
    {
        return $this->array[$this->key];
    }

    public function key()
    {
        return $this->key;
    }

    public function miss()
    {
        return !isset($this->array[$this->key]);
    }

    public function remove()
    {
        unset($this->array[$this->key]);

        return $this;
    }

    public function set($value, $ttl = null)
    {
        return $this->array[$this->key] = $value;
    }
}
