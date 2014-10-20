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

/**
 * Manipulations over a single item from a cache
 */
interface ItemInterface
{
    /**
     * Get the key related to the item
     *
     * @api
     *
     * @return mixed
     */
    function key();

    /**
     * Get the value stored on the cache
     *
     * @api
     *
     * @return mixed
     */
    function get();

    /**
     * Stores a value in the cache
     * Optionally, a time-to-live is specified
     *
     * @api
     * @param mixed $value
     * @param mixed|null $ttl
     *
     * @return mixed
     */
    function set($value, $ttl = null);

    /**
     * If the cache missed while searching for the key
     *
     * @api
     *
     * @return bool
     */
    function miss();

    /**
     * Remove the data related to the key
     *
     * @api
     *
     * @return self
     */
    function remove();
}
