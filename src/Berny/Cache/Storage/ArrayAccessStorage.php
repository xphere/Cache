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

use Berny\Cache\StorageInterface;

class ArrayAccessStorage implements StorageInterface
{
    /** @var \ArrayAccess */
    private $storage;

    public function __construct(\ArrayAccess $storage = null)
    {
        $this->storage = $storage ?: array();
    }

    public function getItem($key)
    {
        return new ArrayAccess\Item($key, $this->storage);
    }

    public function getStorage()
    {
        return $this->storage;
    }
}
