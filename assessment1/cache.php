<?php
require './vendor/autoload.php';

class cacheService
{
    public $redisClient;

    public function __construct() {
        $this->redisClient = new Predis\Client();
    }

    public function setCache(string $key, array $cacheEntry, int $expiry)
    {
        $this->redisClient->set($key, json_encode($cacheEntry));
        $this->redisClient->expire($key, $expiry);
        return true;
    }

    public function getCache(string $key)
    {
        return json_decode($this->redisClient->get($key));
    }

    public function clearallCache()
    {
        return $this->redisClient->flushdb();
    }
}