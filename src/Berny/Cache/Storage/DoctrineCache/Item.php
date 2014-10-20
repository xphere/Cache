<?php

/*
 * This file is part of the Berny\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Berny\Cache\Storage\DoctrineCache;

use Berny\Cache\ItemInterface;
use Doctrine\Common\Cache\Cache;

class Item implements ItemInterface
{
    /**
     * @var Cache
     */
    private $cache;
    private $key;

    function __construct(Cache $cache, $key)
    {
        $this->cache = $cache;
        $this->key = $key;
    }

    public function get()
    {
        return $this->cache->fetch($this->key);
    }

    public function key()
    {
        return $this->key();
    }

    public function miss()
    {
        return !$this->cache->contains($this->key);
    }

    public function remove()
    {
        $this->cache->delete($this->key);

        return $this;
    }

    public function set($value, $ttl = null)
    {
        $this->cache->save($this->key, $value, $ttl);

        return $this;
    }
}
