<?php

namespace App;

use GuzzleHttp\Client;

class YandexDisk
{
    private string $token;
    private Client $http;

    public function __construct(string $token)
    {
        $this->token = $token;

        $this->http = new Client([
            'base_uri' => 'https://cloud-api.yandex.net/v1/disk/',
            'headers' => [
                'Authorization' => "OAuth {$this->token}"
            ]
        ]);
    }

    public function listFiles(string $path = '/')
    {
        $response = $this->http->get('resources', [
            'query' => ['path' => $path]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function upload(string $diskPath, string $filePath)
{
    $response = $this->http->get('resources/upload', [
        'query' => [
            'path' => $diskPath,
            'overwrite' => 'true'
        ]
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    if (!isset($data['href'])) {
        throw new Exception('Не удалось получить upload URL');
    }

    $this->http->put($data['href'], [
        'body' => fopen($filePath, 'r')
    ]);
}

    public function delete(string $path)
    {
        $this->http->delete('resources', [
            'query' => ['path' => $path, 'permanently' => true]
        ]);
    }
}