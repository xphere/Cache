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
use Doctrine\Common\Cache\Cache;

/**
 * Cache for Doctrine\Cache integration
 */
class DoctrineCacheAdapter implements StorageInterface
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getItem($key)
    {
        return new DoctrineCache\Item($this->cache, $key);
    }
}
