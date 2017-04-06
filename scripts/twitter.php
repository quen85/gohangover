<?php
require_once(__DIR__."/../vendor/autoload.php");

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

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

$res = $client->get('search/tweets.json', 
                            ['auth' => 'oauth',
                             'query' => [
                                'q' => "Logan"
                                'result_type' => 'recent'
                              ]
                            ]);
$flux = json_decode($res->getBody()->__toString())->statuses;

foreach ($flux as $twit) {
  echo $twit->text."\n";
}