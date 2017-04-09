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

$client = new Client(['base_uri' => 'https://api.uber.com/v1.2/', 
                      'headers' => [
        'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZXMiOlsiaGlzdG9yeSIsImhpc3RvcnlfbGl0ZSIsInBsYWNlcyIsInByb2ZpbGUiLCJyaWRlX3dpZGdldHMiXSwic3ViIjoiYWM5YjQ1MWItMGE1ZS00OTlhLWEzMmUtZDEyZTRlNjMwNjRkIiwiaXNzIjoidWJlci11czEiLCJqdGkiOiJjN2ZiZTE4Yi0yY2M4LTQ0ZjctOTM5Yy1jNzdiNjJkNDBmNDMiLCJleHAiOjE0OTQzMjgzMzEsImlhdCI6MTQ5MTczNjMzMCwidWFjdCI6IlJwR3ZCQTdLUGM3cUhhVkM3T3ZwNnk0YWFZUHJucyIsIm5iZiI6MTQ5MTczNjI0MCwiYXVkIjoiWkNBZXNLd2V3ZmNVOWhMb3FwcXlxSlVjX2JiYTJ0TWkifQ.cUfP6OHBwe9u9j6-dq6jvb0FjEg9jHlQgCIejDcvyuZH69XdRMkaHxzr2aOvvke12mic0plg2SKxKfkzEo1-EhgAsYI2nAAXYigS0nnhVZyxcciH-NpCNf7sWh07WznIc0tdagE3LpVN877ZQYfy7KCbniKfeHdJHWRJm28ZhXt8F_r-7935bmPgSLvckM_qesKui0QD6-hJJsl_DHxB6NlL8he5UnvaUdkR58q0bga4J4rUXOaKRPMVdQxT5-2s3UsEEtSvfttuslsC_1fb3cULnVIdPtDumTvujwC4qOBAFRYFFfTeXdxhypPyIBqYMTqLswfkjhCPA9O-TG6OPg',
        'Content-Type'     => 'application/json',
        'Accept-Language'      => 'fr_FR'
    ]
                     ]);

$res = $client->post('requests/estimate', ['json' => ['start_latitude' => '48.876388','start_longitude' => '2.358951','end_latitude' => '48.877459','end_longitude' => '2.863822']]);
		
$flux = json_decode($res->getBody()->__toString());
var_dump($flux);