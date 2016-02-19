<?php

namespace AppBundle\Service\Storage;

use AppBundle\Service\KeyValueStorageInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileSystemStorage implements KeyValueStorageInterface
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var Filesystem
     */
    private $fs;

    public function __construct($path)
    {
        $this->path = $path;
        $this->fs = new Filesystem();
    }

    public function get($key)
    {
        return file_get_contents($this->getFullPath($key));
    }

    public function del($key)
    {
        $this->fs->remove($this->getFullPath($key));
    }

    public function set($key, $value)
    {
        $this->fs->dumpFile($this->getFullPath($key), $value);
    }

    public function exists($key)
    {
        return $this->fs->exists($this->getFullPath($key));
    }

    private function getFullPath($key)
    {
        return $this->path . $key;
    }
}
