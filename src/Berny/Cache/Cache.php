<?php

/*
 * This file is part of the Berny\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Berny\Cache;

class Cache
{
    private $storage;
    private $strategy;

    public function __construct(StorageInterface $storage, StrategyInterface $strategy = null)
    {
        $this->storage = $storage;
        $this->strategy = $strategy;
    }

    public function get($key, $default = null)
    {
        $item = $this->getItem($key);
        return $item->miss() ? $default : $item->get();
    }

    public function getOrSet($key, $value, $ttl = null)
    {
        $item = $this->getItem($key);
        if (!$item->miss()) {
            return $item->get();
        }

        $item->set($value, $ttl);

        return $value;
    }

    public function getOrLazySet($key, \Closure $callback, $ttl = null)
    {
        $item = $this->getItem($key);
        if (!$item->miss()) {
            return $item->get();
        }

        $value = $callback();
        $item->set($value, $ttl);

        return $value;
    }

    public function set($key, $value, $ttl = null)
    {
        $this->getItem($key)->set($value, $ttl);
        return $this;
    }

    public function remove($key)
    {
        $item = $this->getItem($key);
        $item->miss() || $item->remove();
        return $this;
    }

    /**
     * @return ItemInterface
     */
    public function getItem($key)
    {
        if ($this->strategy) {
            $key = $this->strategy->getKey($key);
        }
        return $this->storage->getItem($key);
    }
}
