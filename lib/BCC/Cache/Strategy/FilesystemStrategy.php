<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BCC\Cache\Strategy;

use SplFileInfo;
use BCC\Cache\StrategyInterface;

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
