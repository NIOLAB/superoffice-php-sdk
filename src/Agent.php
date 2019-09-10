<?php
namespace nymedia\SuperOffice;


class Agent
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function post($path, $data, $clientOptions = [])
    {
        if (!isset($clientOptions['headers'])) {
            $clientOptions['headers'] = [];
        }
        $clientOptions['headers']['Content-Type'] = 'application/json';

        return $this->client->post('Agents/' . $path , $data, $clientOptions);
    }

}