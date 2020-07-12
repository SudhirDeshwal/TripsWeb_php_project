<?php

function objectToString($mixed = null)
{
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

function bookingCodeGen()
{
  if (function_exists('com_create_guid') === true) {
    return trim(com_create_guid(), '{}');
  }
  return sprintf('%04X %04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479));
}


function getWeather($city)
{
  //step1
  $cSession = curl_init();
  //step2
  curl_setopt($cSession, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=098652f7792b8d57f0480ee34d88e8c5&units=metric");
  curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($cSession, CURLOPT_HEADER, false);
  //step3
  $result = curl_exec($cSession);
  //step4
  curl_close($cSession);
  //step5
  $payload = json_decode($result);
  //echo $payload->name;
  //echo $payload->main->temp;
  //echo $payload->weather[0]->icon;
  //echo $payload->weather[0]->description;


  if ($payload->cod === 200) {
    return
      '<div class="weather_image" id="weather_icon"> <img src="https://openweathermap.org/img/wn/' . $payload->weather[0]->icon . '@2x.png" alt="Weather Icon"></div>
    <div id="city_temp">' . $payload->main->temp . '&#8451; </div>
    <div id="city_conditions">Current Conditions:' . ucfirst($payload->weather[0]->description) . '</div>';
  } else {
    return '<div> Weather not available.</div>';
  }
}
