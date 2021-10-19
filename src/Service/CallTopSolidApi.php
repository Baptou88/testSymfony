<?php


namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallTopSolidApi
{
    private HttpClientInterface $client;
    public static string $base_url = "https://localhost:44305/api/";

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }



    public function getProjects() : array{
        $response = $this->client->request(
            'GET',
            self::$base_url."project/"
        );
        return $response->toArray();
    }
    function getProject($id):array {
        $response = $this->client->request(
            'GET',
            self::$base_url."project/$id"
        );
        return $response->toArray();
    }
    function searchProjectByName(string $projectName){
        $response = $this->client->request(
            'GET',
            self::$base_url."project?name=".$projectName
        );
        return $response->toArray();
    }
}