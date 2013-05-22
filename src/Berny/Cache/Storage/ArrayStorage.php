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
            $this->storage = new ArrayObject($storage ?: array());
        }
    }

    public function getItem($key)
    {
        $value = isset($this->storage[$key]) ? $this->storage[$key] : null;
        if ($value instanceof Memory\Item) {
            return $value;
        }
        return $this->storage[$key] = new Memory\Item($key, $value);
    }
}
