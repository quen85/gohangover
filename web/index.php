<?php
require_once("../vendor/autoload.php");
require_once(__DIR__."/../scripts/yelp.php");
require_once(__DIR__."/../scripts/uber.php");

/**
 * User input is handled here 
 */
$longopts  = array(
    "term::",
    "location::",
);
    
$options = getopt("", $longopts);

$term = $options['term'] ?: $GLOBALS['DEFAULT_TERM'];
$location = $options['location'] ?: $GLOBALS['DEFAULT_LOCATION'];

$bars = query_api($term, $location);
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
    <h1>GoHangover</h1>
    <h2>Find your bar, drink as much as you can and go home safely with Uber !</h2>
    <div class="color-bg">
      <div id="map"></div>
    </div>
    <p>Click on a place on the map and find a Uber. It may take few long seconds sorry</p>
    <script>
      function initMap() {
        var location = {lat: 48.866667, lng: 2.333333};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 48.866667, lng: 2.333333},
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            $lat_loc = pos.lat;
            $lng_loc = pos.lng;
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        }
        <?php foreach ($bars as $bar): ?>
          var marker = new google.maps.Marker({
            position: {
              lat: <?php echo $bar->coordinates->latitude; ?>, 
              lng: <?php echo $bar->coordinates->longitude; ?>
            },
            map: map
          });
          marker.addListener('click', function() {
            navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            window.location = '/gohangover/web/estimation.php?startlat=' + pos.lat + '&startlon=' + pos.lng + '&endlat=' + marker.getPosition().lat() + '&endlon=' + marker.getPosition().lng();
          });
        });
        <?php endforeach; ?>
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOazjxXevIDKf1_pkyxs9wQtZQAeAi_R4&callback=initMap"
    async defer></script>
  </body>
</html>