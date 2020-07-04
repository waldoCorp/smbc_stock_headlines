<?php

/**
 * Function to make a call to the finnhub.io API to determine if stocks are
 * going up or down. Caches result and updates every hour
 *
 *
 * Usage:
 * require_once './get_market_trend.php'
 *
 * $market_up = get_market_trend();
 *
 * No params.
 *
 * Return:
 * bool : True for market going up, False for market going down
 *
**/

function get_market_trend() {

  $market_file = __DIR__ . '/../data/market.json';
  $json = file_get_contents($market_file);
  $json_a = json_decode($json,true);
  $time_created = strtotime($json_a['time_created'] . ' +1 hours');

  $response = $json_a['positive'];

  if ($time_created < time()) {
    // Old market value, need a new one
    $json_a['positive'] = request_market();
    $response = $json_a['positive'];
    // Now stuff it in our file along with current time and date:
    $json_a['time_created'] = date("Y-m-d H:i:s");
    $json_a = json_encode($json_a);
    file_put_contents($market_file, $json_a);
  }

  return $response;
}



// Function to request market trend, not externally used
function request_market() {
    require __DIR__ . '/../keys.php'; // Load our api key in $news_api
    // Set up cURL request:
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://finnhub.io/api/v1/quote?symbol=SPY"); // ETF that tracks S&P 500
    $headers = [
      'X-Finnhub-Token:' . $finn_api
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); // Only return the body text of the request, ignore if it was successful or not (as a return value)
    $results = json_decode(curl_exec($ch),true);
    curl_close($ch);

    // Now decide if it went up or down:
    $up = false;
    if ($results['c'] > $results['pc']) {
      $up = true;
    }

    return $up;

}
