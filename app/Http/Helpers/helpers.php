<?php

  function longlat() {
    $ip = Request::ip();
    //$ip = '165.22.95.48';
    $query = json_decode(file_get_contents('https://geoip-db.com/json/'.$ip));

    return ['latitude' => $query->latitude, 'longitude' => $query->longitude];
  };

?>