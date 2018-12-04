<?php declare(strict_types=1);

namespace src\components\Memcache;

use Exception;
use Prophecy\Exception\InvalidArgumentException;

class Memcache implements MemcacheInterface
{
    const MEMCACHED_DEFAULT_PORT = 11211;
    const MEMCACHED_DEFAULT_SERVER = "127.0.0.1";
    const MEMCACHED_EXP_TIME = 3600;
    const SOCKET_READ_LENGTH = 128;
    const SOCKET_FLAGS = 0;

    /**
     * @var $sock resource
     */
    private $sock;

    /**
     * Create socket connection to memcached
     * @param $ip string ip address where is memcached located
     * @param $port integer memcached port
     * @return string or Exception
     */
    public function connect($ip = self::MEMCACHED_DEFAULT_SERVER, $port = self::MEMCACHED_DEFAULT_PORT):string
    {

        if (empty($ip) || empty($port)) {
            throw new InvalidArgumentException(' ip address and port of memcached server must be set');
        }

        $this->sock = @fsockopen($ip, $port, $errno, $errstr);

        if (!$this->sock) {
            return "Connection ERROR: $errno - $errstr<br />\n";
        }

        return 'Success';
    }

    /**
     * Reading key from memcached
     * @param $key string
     * @return string
     */
    public function get(string $key):string
    {
        $this->checkConnection();

        fwrite($this->sock, "get ' . $key . '\r\n");
        $buffer = fread($this->sock, self::SOCKET_READ_LENGTH);
        $lines = preg_split('/\r\n/', $buffer);

        if (!empty($lines[1])) {
            return $lines[1];
        }

        return 'Undefined';
    }

    /**
     * Setting key value to memcached
     * @param $key string
     * @param $value string
     * @param $exptime integer
     * @param $flags integer
     * @throws Exception
     * @return string or Exception
     */
    public function set(
        string $key,
        string $value,
        $exptime = self::MEMCACHED_EXP_TIME,
        $flags = self::SOCKET_FLAGS
    ):string {
        $this->checkConnection();

        $execute = "set $key $flags $exptime " . strlen($value) . "\r\n";
        fwrite($this->sock, $execute);
        fwrite($this->sock, $value . "\r\n");
        $response = fgets($this->sock, self::SOCKET_READ_LENGTH);

        return $response;
    }

    /**
     * Deleting key value from memcached
     * @param $key string
     * @return string or Exception
     */
    public function delete($key):string
    {
        $this->checkConnection();

        fwrite($this->sock, "delete $key \r\n");
        $response = fread($this->sock, self::SOCKET_READ_LENGTH);

        return $response;
    }

    /**
     * Check if socket connected
     * @throws Exception
     */
    private function checkConnection()
    {
        if (gettype($this->sock) !== 'resource') {
            throw new \Exception(' Please connect to memcached first ');
        }
    }

    /**
     * Close connection
     */
    public function close()
    {
        fclose($this->sock);
    }
}
