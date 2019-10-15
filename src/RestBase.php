<?php

namespace nymedia\SuperOffice;

class RestBase
{

    protected $resourcePath;

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function post($data, $clientOptions = [])
    {
        return $this->client->post($this->resourcePath, $data, $clientOptions);
    }

    public function get($path = null, $clientOptions = [])
    {
        $assembled_path = $this->resourcePath;
        if ($path) {
            $assembled_path = sprintf('%s/%s', $this->resourcePath, $path);
        }
        return $this->client->get($assembled_path, null, $clientOptions);
    }


    public function getStream($path)
    {
        return $this->client->get($this->resourcePath . '/' . $path, null, ['stream' => true]);
    }

    public function getWithParameters($path = '', $params = [], $clientOptions = [])
    {
        return $this->client->get($this->resourcePath . '/' . $path, $params, $clientOptions);
    }

    public function put($id, $data, $clientOptions = [])
    {
        return $this->client->put($this->resourcePath . '/' . $id, $data, $clientOptions);
    }

    public function patch($id, $data, $clientOptions = [])
    {
        return $this->client->patch($this->resourcePath . '/' . $id, $data, $clientOptions);
    }

    public function delete($id, $clientOptions = [])
    {
        return $this->client->delete($this->resourcePath . '/' . $id, null, $clientOptions);
    }

}
