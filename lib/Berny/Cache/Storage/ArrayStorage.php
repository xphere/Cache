<?php

/*
 * This file is part of the Berny\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Berny\Cache\Storage;

use ArrayObject;
use Berny\Cache\StorageInterface;

class ArrayStorage implements StorageInterface
{
    private $storage;

    public function __construct($storage = null)
    {
        if (!is_object($storage) || $storage instanceof ArrayAccess) {
            $storage = new ArrayObject($storage ?: array());
        }
        foreach ((array)$storage as $key => $value) {
            $this->storage[$key] = new Memory\Item($key, $value);
        }
    }

    public function getItem($key)
    {
        if (!isset($this->storage[$key])) {
            $this->storage[$key] = new ArrayItem($key);
        }
        return $this->storage[$key];
    }
}
