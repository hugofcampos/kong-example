<?php

use GuzzleHttp\Client as GuzzleClient;

class JWTClient
{
    const endpoint = 'http://192.168.99.100:8001';

    protected function sendRequest($method, $url, $options=[])
    {
        $client = new GuzzleClient;
        $request = $client->request(
            $method,
            $url,
            $options
        );
        return json_decode($request->getBody()->getContents(), true);
    }

    public function get($consumer)
    {
        $options = [
            'json' => [],
            'headers' => ["Content-Type" => "application/json"]
        ];

        $url = sprintf('%s/consumers/%s/jwt', self::endpoint, $consumer);
        $response = $this->sendRequest('GET', $url, $options);

        if (empty($response["data"])) {
            return false;
        }
        return $response;
    }

    public function getOne($consumer)
    {
        $options = [
            'json' => [],
            'headers' => ["Content-Type" => "application/json"]
        ];

        $url = sprintf('%s/consumers/%s/jwt', self::endpoint, $consumer);
        $response = $this->sendRequest('GET', $url, $options);

        if (empty($response["data"])) {
            return false;
        }
        return $response["data"][0];
    }

    public function create($consumer)
    {
        $options = [
            'json' => [],
            'headers' => ["Content-Type" => "application/json"]
        ];

        $url = sprintf('%s/consumers/%s/jwt', self::endpoint, $consumer);

        return $this->sendRequest('POST', $url, $options);
    }
}
