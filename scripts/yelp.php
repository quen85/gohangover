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
$oauth = new Oauth1([
  'grant_type'   => 'client_credentials',
  'client_id'   => 'HtTI4LUFLFJvvnR5V4foVA',
  'client_secret'   => 'gBMZy7u6UeACA1EcLOJO5LMMP11LDahXbsGguKpuYdLBdQw2aVfvLqhQU3j3ezQo'
  ]);
$stack->push($oauth);

$client = new Client(['base_uri' => 'https://api.yelp.com/v3/', 
                      'handler' => $stack
                     ]);

$app->get('/bars', function(Request $request) use ($app){
  $res = $client->get('businesses/search', 
                            ['term' => 'bars',
                            'latitude' => 37.786882,
                            'longitude' => -122.399972
                            ]);
  $flux = json_decode($res->getBody()->__toString());
  return new JsonResponse($flux, 200);
});