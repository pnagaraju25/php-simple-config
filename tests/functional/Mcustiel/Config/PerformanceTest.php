<?php
namespace Functional\Config;

use Mcustiel\Config\Drivers\Reader\php\Reader as PhpReader;
use Mcustiel\Config\Drivers\Reader\ini\Reader as IniReader;
use Mcustiel\Config\Drivers\Reader\json\Reader as JsonReader;
use Mcustiel\Config\Drivers\Reader\yaml\Reader as YamlReader;
use Mcustiel\Config\Drivers\Cacher\file\php\Cacher as PhpCacher;
use Mcustiel\Config\ConfigLoader;

class PerformanceTest extends \PHPUnit_Framework_TestCase
{

    public function testPerformanceWithoutCacheForDifferentReaders()
    {
        $readers = [
            FIXTURES_PATH . "/test.php" => new PhpReader(),
            FIXTURES_PATH . "/test.ini" => new IniReader(),
            FIXTURES_PATH . "/test.json" => new JsonReader(),
            FIXTURES_PATH . "/test.yml" => new YamlReader()
        ];
        $cyclesCount = [
            10000
        ];

        foreach ($readers as $filename => $reader) {
            $loader = new ConfigLoader($filename, $reader);
            foreach ($cyclesCount as $cycles) {
                $start = microtime(true);
                for ($i = $cycles; $i > 0; $i --) {
                    $loader->load();
                    $loader->getConfig();
                }
                echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                    . " seconds for " . get_class($reader) . " without cache \n";
            }
        }
    }

    public function testPerformanceWithCacheForDifferentReaders()
    {
        $readers = [
            FIXTURES_PATH . "/test.php" => new PhpReader(),
            FIXTURES_PATH . "/test.ini" => new IniReader(),
            FIXTURES_PATH . "/test.json" => new JsonReader(),
            FIXTURES_PATH . "/test.yml" => new YamlReader()
        ];
        $cyclesCount = [
            5000,
            15000,
            25000
        ];

        foreach ($readers as $filename => $reader) {
            $loader = new ConfigLoader($filename, $reader, new PhpCacher());
            foreach ($cyclesCount as $cycles) {
                $start = microtime(true);
                for ($i = $cycles; $i > 0; $i --) {
                    $loader->load();
                    $loader->getConfig();
                }
                echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                    . " seconds for " . get_class($reader) . " with cache \n";
            }
        }
    }
}