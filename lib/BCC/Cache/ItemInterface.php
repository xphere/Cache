<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BCC\Cache;

/**
 * Manipulations over a single item from a cache
 */
interface ItemInterface
{
    function key();
    function get();
    function set($value, $ttl = null);
    function miss();
    function remove();
}
