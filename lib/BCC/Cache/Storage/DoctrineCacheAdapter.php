<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BCC\Cache\Storage;

use BCC\Cache\StorageInterface;
use Doctrine\Common\Cache\Cache;

class DoctrineCacheAdapter implements StorageInterface
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getItem($key)
    {
        return new DoctrineCache\Item($cache, $key);
    }
}