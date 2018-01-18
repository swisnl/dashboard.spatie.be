<?php

namespace App\GameOfTests;

use GuzzleHttp\Client;

class GameOfTests
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var string */
    protected $baseUrl;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $baseUrl
     */
    public function __construct(Client $client, $baseUrl = 'https://packagist.org')
    {
        $this->client = $client;

        $this->baseUrl = $baseUrl;
    }

    /**
     * @return array
     */
    public function getTotals()
    {
        return $this->makeRequest('/api/all');
    }

    /**
     * @return array
     */
    public function getLastMonth()
    {
        return $this->makeRequest('/api/last-months', ['months_back' => 1]);
    }

    /**
     * @return array
     */
    public function getTeams()
    {
        return $this->makeRequest('/api/teams');
    }

    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    public function makeRequest($resource, array $query = [])
    {
        $packages = $this->client
            ->get("{$this->baseUrl}{$resource}", compact('query'))
            ->getBody()
            ->getContents();

        return json_decode($packages, true);
    }
}
