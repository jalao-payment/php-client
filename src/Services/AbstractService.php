<?php

namespace Jalao\Services;

abstract class AbstractService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    protected function request($method, $path, $params, $options)
    {
        return $this->client->request($method, $path, $params, $options);
    }
}
