<?php
require_once("../vendor/autoload.php");
require_once(__DIR__."/../scripts/yelp.php");
require_once(__DIR__."/../scripts/uber.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <title>GoHangover</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Barrio|Linden+Hill" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/map.css">
  </head>
  <body>
    <div class="uber">
    <a href="index.php"><- Go Back</a>
      <h1>Estimation du trajet :</h1>
      <?php $estimation = getEstimation($_GET['startlat'], $_GET['startlon'], $_GET['endlat'], $_GET['endlon']); ?>
      <p>Distance : <?php echo ($estimation->trip->distance_estimate*1.60934); ?> km</p>
      <p>Durée : <?php echo ($estimation->trip->duration_estimate / 60); ?> min</p>
      <p>Prix : <?php echo $estimation->fare->value; ?> euros</p>
    </div>
  </body>
</html>