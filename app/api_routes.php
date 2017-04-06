<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\DBAL\Query\QueryBuilder;

$qb = new QueryBuilder($app['db']);

$app->get('/', function(Request $request) use ($app, $qb){
  $q = $request->query->get("q");
  return new JsonResponse(["ok" => $q], 200);
});