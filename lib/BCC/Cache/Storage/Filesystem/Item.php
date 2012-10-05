<?php

/*
 * This file is part of the BCC\Cache package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BCC\Cache\Storage\Filesystem;

use SplFileInfo;
use BCC\Cache\ItemInterface;

class Item implements ItemInterface
{
    private $key;
    private $filename;

    public function __construct($key, $filename)
    {
        $this->key = $key;
        $this->filename = $filename;
    }

    public function get()
    {
        return unserialize(file_get_contents($this->filename));
    }

    public function key()
    {
        return $this->key;
    }

    public function miss()
    {
        $info = $this->fileInfo();
        return !$info->isFile() || $info->getMTime() < time();
    }

    public function remove()
    {
        if ($this->fileInfo()->isFile()) {
            unlink($this->filename);
        }
    }

    public function set($value, $ttl = null)
    {
        $path = $this->fileInfo()->getPathInfo();
        if (!$path->isDir()) {
            mkdir($path, 0777, true);
        }
        file_put_contents($this->filename, serialize($value));
        touch($this->filename, time() + ($ttl ?: 315360000));
    }

    /**
     * @return SplFileInfo
     */
    private function fileInfo()
    {
        if (is_string($this->filename)) {
            $this->filename = new SplFileInfo($this->filename);
        }
        return $this->filename;
    }
}
