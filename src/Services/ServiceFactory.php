<?php

namespace Jalao\Services;

class ServiceFactory
{
    private $client;

    private $services;

    private static $classMap = [
        'transaction' => TransactionService::class,
        'customer' => CustomerService::class,
    ];

    public function __construct($client)
    {
        $this->client = $client;
        $this->services = [];
    }

    public function __get($name)
    {
        return $this->getService($name);
    }

    public function getService($name)
    {
        $serviceClass = $this->getServiceClass($name);
        if ($serviceClass !== null) {
            if (!\array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass($this->client);
            }

            return $this->services[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }

    private function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
