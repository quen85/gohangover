<?php
require_once(__DIR__."/../vendor/autoload.php");

use \GuzzleHttp\Client;

$client = new Client(['base_uri' => "http://alloseance.app"]);

