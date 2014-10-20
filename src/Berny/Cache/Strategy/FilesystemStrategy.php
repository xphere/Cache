<?php

/*
 * This file is part of the Berny\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Berny\Cache\Strategy;

use SplFileInfo;
use Berny\Cache\StrategyInterface;

/**
 * This strategy uses last modified time of filesystem for key generation
 */
class FilesystemStrategy implements StrategyInterface
{
    public function getKey($item)
    {
        if ($item instanceof SplFileInfo === false) {
            $item = new SplFileInfo($item);
        }

        return $item->getPath() . '#' . $item->getMTime();
    }
}
