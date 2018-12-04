<?php declare(strict_types=1);

namespace src\components\Memcache;

use Exception;

interface MemcacheInterface
{
    /**
     * Create socket connection to memcached
     * @param $ip string ip address where is memcached located
     * @param $port integer memcached port
     * @throws Exception
     * @return string
     */
    public function connect($ip, $port):string;

    /**
     * Reading key from memcached
     * @param $key string
     * @throws Exception
     * @return string
     */
    public function get(string $key):string;

    /**
     * Setting key value to memcached
     * @param $key string
     * @param $value string
     * @param $exptime integer
     * @param $flags integer
     * @throws Exception
     * @return string or Exception
     */
    public function set(string $key, string $value, $exptime, $flags):string;

    /**
     * Deleting key value from memcached
     * @param $key string
     * @throws Exception
     * @return string
     */
    public function delete($key):string;

    /**
     * Close connection
     */
    public function close();
}
