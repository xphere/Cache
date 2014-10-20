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

    /**
     * @api
     * @param StorageInterface $storage
     * @param StrategyInterface $strategy
     */
    public function __construct(StorageInterface $storage, StrategyInterface $strategy = null)
    {
        $this->storage = $storage;
        $this->strategy = $strategy;
    }

    /**
     * Retrieves data from the cache
     * Gets default value on cache misses
     *
     * @api
     * @param mixed $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $item = $this->getItem($key);

        return $item->miss() ? $default : $item->get();
    }

    /**
     * Retrieves data from the cache
     * Sets value on cache misses
     *
     * @api
     * @param mixed $key
     * @param mixed $value
     * @param mixed|null $ttl
     *
     * @return mixed
     */
    public function getOrSet($key, $value, $ttl = null)
    {
        $item = $this->getItem($key);
        if (!$item->miss()) {
            return $item->get();
        }

        $item->set($value, $ttl);

        return $value;
    }

    /**
     * Retrieves data from the cache
     * Sets value from a closure call on cache misses
     *
     * @api
     * @param mixed $key
     * @param callable $callback
     * @param mixed|null $ttl
     *
     * @return mixed
     */
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

    /**
     * Saves data onto the cache
     *
     * @api
     * @param mixed $key
     * @param mixed $value
     * @param mixed|null $ttl
     *
     * @return self
     */
    public function set($key, $value, $ttl = null)
    {
        $this->getItem($key)->set($value, $ttl);

        return $this;
    }

    /**
     * Remove an item from the cache
     *
     * @api
     * @param $key
     *
     * @return self
     */
    public function remove($key)
    {
        $item = $this->getItem($key);
        $item->miss() || $item->remove();

        return $this;
    }

    /**
     * Retrieves an item from a key and the current cache storage
     * Always returns an item object, even for cache misses
     *
     * @api
     * @param mixed $key
     *
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
