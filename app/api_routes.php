<?php
require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../scripts/yelp.php");

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



$app->get('/bars', function(Request $request) use ($app){
  return "boo";
});