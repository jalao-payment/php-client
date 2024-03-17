<?php

namespace Jalao;

use Jalao\Services\ServiceFactory;

class Client
{
    const JALAO_LIVE_ENDPOIT = 'https://api.jalao.com/v1';
    const JALAO_TEST_ENDPOIT = 'https://api-sandbox.jalao.com/v1';

    private $httpClient;
    private $endpoint;
    private $token;
    private $serviceFactory;

    public function __construct($config)
    {
        $endpoint = isset($config['endpoint']) && $config['endpoint'] === 'live' ? self::JALAO_LIVE_ENDPOIT : self::JALAO_TEST_ENDPOIT;
        $this->httpClient = new \GuzzleHttp\Client(['verify' => false]);

        $this->endpoint = $endpoint;
        $this->token = $config['token'];
    }

    public function __get($name)
    {
        if ($this->serviceFactory === null) {
            $this->serviceFactory = new ServiceFactory($this);
        }

        return $this->serviceFactory->getService($name);
    }

    public function request($method, $path, $params = [], $options = [])
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
            'User-Agent' => 'Jalao/v1 PHP',
            'Accept' => 'application/json',
        ];

        if (isset($options['project_id'])) {
            $headers['X-Project-Id'] = $options['project_id'];
        }

        $response = $this->httpClient->request($method, $this->endpoint . $path, [
            'headers' => $headers,
            'json' => $params,
        ]);

        return json_decode($response->getBody(), true);
    }
}
