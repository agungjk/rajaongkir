<?php

namespace Agungjk\Rajaongkir;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RajaOngkir
{
    protected $guzzle;
    protected $endpoint;
    protected $key;
    private $error;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;

        $this->city = json_decode(file_get_contents(__DIR__.'/config/city.json'));
        $this->province = json_decode(file_get_contents(__DIR__.'/config/province.json'));
    }

    public function province($id = null)
    {
        $uri = '/province';

        if (empty($id)) {
            return empty($this->province) ? $this->get($uri)->results : $this->province;
        }

        if (empty($this->province)) {
            $uri .= '?'.http_build_query(compact('id'));

            return $this->get($uri)->results;
        }

        foreach ($this->province as $key => $value) {
            if ($value->province_id == $id) {
                return $value;
            }
        }

        return null;
    }

    public function city($id = null)
    {
        $uri = '/city';

        if (empty($id)) {
            return empty($this->city) ? $this->get($uri)->results : $this->city;
        }

        if (empty($this->city)) {
            $uri .= '?'.http_build_query(compact('id'));

            return $this->get($uri)->results;
        }

        foreach ($this->city as $key => $value) {
            if ($value->city_id == $id) {
                return $value;
            }
        }

        return null;
    }

    public function cost($origin, $destination, $weight, $courier)
    {
        $uri = '/cost';

        $response = $this->post($uri, compact('origin', 'destination', 'weight', 'courier'));

        return [
            'origin' => $response->origin_details,
            'destination' => $response->destination_details,
            'results' => $response->results,
        ];
    }

    protected function parseResponse(Response $response)
    {
        $body = $response->getBody()->getContents();

        $data = json_decode($body);

        if (empty($data->rajaongkir) || empty($data->rajaongkir->status)) {
            throw new Exception('Empty response');
        }

        $data = $data->rajaongkir;

        if ($data->status->code != 200) {
            throw new Exception($data->status->description);
        }

        return $data;
    }

    protected function get($path, $options = [])
    {
        $uri = trim($path, '/').'?'.http_build_query($options);

        $response = $this->guzzle->get($uri);

        return $this->parseResponse($response);
    }

    protected function post($path, $options = [])
    {
        $uri = trim($path, '/');

        $response = $this->guzzle->post($uri, [
            'form_params' => $options,
        ]);

        return $this->parseResponse($response);
    }
}
