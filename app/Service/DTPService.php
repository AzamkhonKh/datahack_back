<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class DTPService
{
    public Client $client;
    public int $page_size;

    public function __construct()
    {
        $datas = config('services')['datas'];
        $endpoint = $datas['dtp'];
        $this->page_size = $datas['page_size'];
        $this->client = new Client([
            'base_uri' => $endpoint,
        ]);
    }

    public function paginate(int $page = 1): Collection
    {
        $response = $this->client->get('/api/egov/open_data/',[
            'query' => [
                'page' => $page,
                'page_size' => $this->page_size
            ]
        ])->getBody()->getContents();
        return collect(json_decode($response, 1)['results']);
    }

    public function accident_count(): int
    {
        $response = $this->client->get('/api/egov/open_data/',[
            'query' => [
                'page' => 1,
                'page_size' => $this->page_size
            ]
        ])->getBody()->getContents();
        $data = json_decode($response);
        return $data->count;
    }
}