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
namespace Mcustiel\Config\Drivers\Reader\php;

use Mcustiel\Config\ConfigReader;
use Mcustiel\Config\Config;
use Mcustiel\Config\Drivers\Reader\BaseReader;
use Mcustiel\Config\Exception\ConfigParsingException;

class Reader extends BaseReader implements ConfigReader
{
    public function read($filename)
    {
        $this->config = @include $filename;
        if ($this->config === false) {
            throw new ConfigParsingException("An error occurred while parsing php file {$filename}");
        }
    }
}
