<?php

namespace mcustiel\config;

interface ConfigCacher
{
    public function setOptions(\stdClass $options);
    public function setName($name);
    public function save(Config $config);
    public function load();
    public function exists();
}
