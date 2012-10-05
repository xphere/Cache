<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BCC\Cache\Storage;

use BCC\Cache\StorageInterface;

class FilesystemStorage implements StorageInterface
{
    private $path;
    private $extension;

    public function __construct($path, $extension = null)
    {
        $this->path = substr($path, -1) !== '/' ? $path . '/' : $path;
        $this->extension = $extension;
    }

    public function getItem($key)
    {
        return new Filesystem\Item($key, $this->locate($key), $this);
    }

    private function locate($key)
    {
        $hash = md5($key);
        return $this->path . substr($hash, 0, 4) . '/' . substr($hash, 4) . $this->extension;
    }
}
