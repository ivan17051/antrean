<?php

namespace App\Helpers;

use GuzzleHttp;

class Http
{

    public static function get($url)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get($url);
        return $response;
    }


    public static function post($url,$body, $header=[]) {
        $header = array_merge($header,['X-CSRF-TOKEN'=>csrf_token()]);
        $client = new GuzzleHttp\Client();
        $response = $client->post($url, ['form_params' => $body, 'headers' => $header]);
        return $response;
    }
}
