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

interface StorageInterface
{
    /**
     * Returns specific item related to a key
     *
     * @api
     * @param mixed $key
     *
     * @return ItemInterface
     */
    function getItem($key);
}
