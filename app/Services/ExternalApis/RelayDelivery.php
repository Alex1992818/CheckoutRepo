<?php


namespace App\Services\ExternalApis;


class RelayDelivery extends BaseApi
{
    private $token;

    public function __construct()
    {
        $prefix = '';
        if (env('RELAY_MODE') == null || env('RELAY_MODE') == 'dev' || env('APP_ENV') == 'local') {
            //$prefix = 'dev-';
        }
        $this->client = $this->client('https://' . $prefix . 'api.relay.delivery/v1/');
        $this->token = env('RELAY_TOKEN');
    }

    public function createOrder($order, $key)
    {
        $method = self::POST;
        $uri = 'orders';
        $headers = [
            'headers' => [
                'x-relay-auth' => $key,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
            'json' => $order
        ];
        return $this->request($method, $uri, $headers, self::JSON);
    }

    public function canDeliverTo($location, $key)
    {
        $method = self::POST;
        $uri = 'can-deliver';
        $headers = [
            'headers' => [
                'x-relay-auth' => $key,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
            'json' => $location
        ];
        $result = false;
        $result = $this->request($method, $uri, $headers, self::JSON)->canDeliver;
        
        return $result;
    }

    public function voidOrder($orderKey)
    {

    }
}