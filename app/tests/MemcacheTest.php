<?php
/**
 * Created by PhpStorm.
 * User: ckwor
 * Date: 08.09.2018
 * Time: 17:30
 */
//require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../components/Memcache.php';

namespace tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use src\components\Memcache\Memcache;

class MemcacheTest extends TestCase
{
    /**
     * @var Memcache
     */
    protected $ob;

    /**
     * MemcacheTest constructor.
     * @internal param Memcache $ob
     */
    public function __construct()
    {
        parent::__construct();
        $this->ob = new Memcache();
    }

    public function testConnect()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->ob->connect('172.23.81.87', '');
    }

    public function testSet()
    {
        $this->expectOutputString("STORED\r\n");
        $this->ob->connect('172.23.81.87', 11211);
        echo $this->ob->set('key', 999);
    }

    public function testGet()
    {
        $this->expectException(\Exception::class);
        echo $this->ob->get(1);
    }

    protected function tearDown()
    {
        $this->ob = null;
    }

}