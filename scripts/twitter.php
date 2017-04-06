<?php
require_once(__DIR__."/../vendor/autoload.php");

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

$stack = HandlerStack::create();

include(__DIR__."/config.php");
$oauth = new Oauth1([
  'consumer_key'   => '',
  'consumer_secret'   => '',
  'token'   => '',
  'token_secret'   => ''
  ]);
$stack->push($oauth);

$client = new Client(['base_uri' => 'https://api.twitter.com/1.1/', 
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