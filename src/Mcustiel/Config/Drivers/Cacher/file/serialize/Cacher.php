<?php
/**
 * This file is part of php-simple-config.
 * 
 * php-simple-config is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * php-simple-config is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with php-simple-config.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Mcustiel\Config\Drivers\Cacher\file\serialize;

use Mcustiel\Config\Drivers\Cacher\file\BaseCacher;

class Cacher extends BaseCacher
{
    protected function getSerializedConfig(array $config)
    {
        return serialize($config);
    }

    protected function getUnserializedConfig()
    {
        $return = file_get_contents($this->fullPath);
        return ($return === false)? null : unserialize($return);
    }

    protected function generateFilePath()
    {
        return "{$this->path}/php.simple.config.cache.{$this->cacheName}.ser";
    }
}
