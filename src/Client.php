<?php

namespace nymedia\SuperOffice;

use nymedia\SuperOffice\resources\Contact;
use nymedia\SuperOffice\resources\Document;
use nymedia\SuperOffice\resources\Person;
use nymedia\SuperOffice\resources\Project;
use nymedia\SuperOffice\resources\ProjectMember;
use nymedia\SuperOffice\resources\Ticket;

class Client
{

    /**
     * @var null|\GuzzleHttp\Client
     */
    protected $client;

    protected $url;

    protected $password;

    protected $user;

    protected $language = 'en';

    public function getClient()
    {
        if (!$this->client) {
            $this->client = new \GuzzleHttp\Client();
        }
        return $this->client;
    }

    public function __construct($url, $user, $password, $client = null, $language)
    {
        $this->url = $url;
        $this->client = $client;
        $this->user = $user;
        $this->password = $password;
        $this->language = $language;
    }

    public function projectMember()
    {
        return new ProjectMember($this);
    }

    public function person()
    {
        return new Person($this);
    }

    public function contact()
    {
        return new Contact($this);
    }

    public function project()
    {
        return new Project($this);
    }

    public function document()
    {
        return new Document($this);
    }

    public function ticket()
    {
        return new Ticket($this);
    }

    public function get($path, $data = null, $clientOptions = [])
    {
        return $this->apiCall('GET', $this->url . '/' . $path, $data, $clientOptions);
    }

    public function post($path, $data, $clientOptions = [])
    {
        return $this->apiCall('POST', $this->url . '/' . $path, $data, $clientOptions);
    }

    public function put($path, $data, $clientOptions = [])
    {
        return $this->apiCall('PUT', $this->url . '/' . $path, $data, $clientOptions);
    }


    protected function apiCall($method, $path, $data = null, $clientOptions = [])
    {
        $opts = [
            'headers' => [
                'User-Agent' => 'Superoffice PHP SDK (https://github.com/nymedia/superoffice-php-sdk)',
                'Accept' => 'application/json',
                'Accept-Language' => $this->language,
            ],
            'auth' => [$this->user, $this->password],
        ];
        if ($clientOptions) {
            $opts = array_merge($opts,$clientOptions);
        }
        if ($data && $method != 'GET') {
            // Set all needed options with this shorthand.
            $opts['json'] = $data;
        } elseif ($data) {
            $opts['query'] = $data;
        }

        return $this->getClient()->request($method, $path, $opts);
    }
}
