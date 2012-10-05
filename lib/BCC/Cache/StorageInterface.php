<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Returns specific item related to a key
 */

namespace BCC\Cache;

interface StorageInterface
{
    /**
     * @var ItemInterface
     */
    function getItem($key);
}
