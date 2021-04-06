<?php namespace Lingwave\CloudConvertLaravel;

use GuzzleHttp\Client;
use Lingwave\CloudConvertLaravel\HttpClientAdapter\Guzzle5Adapter;
use Lingwave\CloudConvertLaravel\HttpClientAdapter\Guzzle6Adapter;

trait HttpClient
{

    public $http;

	/**
     * @param HttpClientAdapter\HttpClientInterface $adapter
     */
    public function setClient($adapter = null)
    {
        if(! is_null($adapter)) {
            $this->http = $adapter;
        } else {
            $this->setGuzzleAdapter();
        }
    }

    public function setGuzzleAdapter()
    {
        switch (true) {
            case ( defined('Client::VERSION') && version_compare(Client::VERSION, '6.0.0', '<') ):
                $this->http = new Guzzle5Adapter;
                break;
            case true:
                $this->http = new Guzzle6Adapter;
                break;
        }
    }

}
