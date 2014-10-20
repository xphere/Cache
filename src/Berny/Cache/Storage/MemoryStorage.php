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

/**
 * Cache stored in memory array
 * Allows any implementation of ArrayAccess
 */
class MemoryStorage implements StorageInterface
{
    /** @var Memory\Item[] */
    private $storage;

    public function __construct($storage = null)
    {
        if ($storage && !is_array($storage) && !$storage instanceof \ArrayAccess) {
            throw new \DomainException('Memory storage must be an array or ArrayAccess');
        }

        $this->storage = $storage ?: [];
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
