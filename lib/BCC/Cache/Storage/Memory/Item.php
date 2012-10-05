<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace xphere\Cache\Storage\Item;

use xphere\Cache\ItemInterface;

class ArrayItem implements ItemInterface
{
    private $key;
    private $value;
    private $expires;

    public function __construct($key, $value = null, $expires = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->expires = $expires;
    }

    public function get()
    {
        return $this->value;
    }

    public function key()
    {
        return $this->key;
    }

    public function miss()
    {
        return $this->value === null || ($this->expires !== null && $this->expires < time());
    }

    public function remove()
    {
        $this->value = null;
        $this->expires = null;
        return $this;
    }

    public function set($value, $ttl = null)
    {
        $this->value = $value;
        $this->expires = $ttl ? time() + $ttl : null; 
        return $this;
    }
}
