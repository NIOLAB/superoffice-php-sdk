<?php

namespace nymedia\SuperOffice;

class RestBase {

  protected $resourcePath;

  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function post($data)
  {
    return $this->client->post($this->resourcePath, $data);
  }

  public function get($path = null)
  {
    $assembled_path = $this->resourcePath;
    if ($path) {
      $assembled_path = sprintf('%s/%s', $this->resourcePath, $path);
    }
    return $this->client->get($assembled_path);
  }

  public function getStream($path)
  {
      return $this->client->get($this->resourcePath . '/' . $path, null, ['stream'=>true]);
  }

  public function getWithParameters($path = '', $params = [])
  {
    return $this->client->get($this->resourcePath . '/' . $path, $params);
  }

  public function put($id, $data)
  {
    return $this->client->put($this->resourcePath . '/' . $id, $data);
  }

}
