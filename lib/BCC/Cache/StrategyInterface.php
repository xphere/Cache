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
 * Converts user-domain items into generic keys for the underlying storage
 */
interface StrategyInterface
{
    function getKey($item);
}
