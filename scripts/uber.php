<?php
require_once(__DIR__."/../vendor/autoload.php");

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$stack = HandlerStack::create();

include(__DIR__."/config.php");

function getEstimation($start_latitude, $start_longitude, $end_latitude, $end_longitude){

	$client = new Client(['base_uri' => 'https://api.uber.com/v1.2/', 
                      'headers' => [
        'Authorization' => 'Bearer '.$GLOBALS['TOKEN_UBER'],
        'Content-Type'     => 'application/json',
        'Accept-Language'      => 'fr_FR'
    ]
                     ]);
	$res = $client->post('requests/estimate', ['json' => ['start_latitude' => $start_latitude,'start_longitude' => $start_longitude,'end_latitude' => $end_latitude,'end_longitude' => $end_longitude]]);
		
	$flux = json_decode($res->getBody()->__toString());
	return $flux;
}