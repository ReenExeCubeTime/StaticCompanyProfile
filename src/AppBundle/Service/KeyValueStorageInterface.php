<?php

namespace AppBundle\Service;

interface KeyValueStorageInterface
{
    public function get($key);
    public function set($key, $value);
    public function del($key);
    public function exists($key);
}