<?php

/**
 * Function to make a call to the newsapi.org API to get a random headline for
 * display. Firsts checks against our cached headline's age and only updates if
 * it is older than 1 hour.
 *
 * Usage:
 * require_once './get_headline.php'
 *
 * $headline = get_headline();
 *
 * No params.
 *
 * Return:
 * array('headline'=>'text', 'url'=>'https://example...')
 *
**/

function get_headline() {

  $headline_file = __DIR__ . '/../data/headline.json';
  $json = file_get_contents($headline_file);
  $json_a = json_decode($json,true);
  $time_created = strtotime($json_a['time_created'] . ' +1 hours');

  $response = array('headline'=>$json_a['headline'],'url'=>$json_a['url']);
  if ($time_created < time()) {

    // Old headline, need a new one
    $response = request_headline();
    // Now stuff it in our file along with current time and date:
    $json_a = $response;
    $json_a['time_created'] = date("Y-m-d H:i:s");
    $json_a = json_encode($json_a);
    file_put_contents($headline_file, $json_a);
  }
  return $response;
}



// Function to request headlines, not externally used
// returns a single random headline array: array('headline'=>...,'url'=>...);
function request_headline() {
    require __DIR__ . '/../keys.php'; // Load our api key in $api_key
    // Set up cURL request:
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://newsapi.org/v2/top-headlines?country=us"); // add &pageSize=NUMBER to limit number of results (100 is max), 20 is default
    $headers = [
      'X-Api-Key:' . $api_key
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); // Only return the body text of the request, ignore if it was successful or not (as a return value)
    $results = json_decode(curl_exec($ch),true); // Default is 20 results
    curl_close($ch);

    // Now we need to pick one at random:
    $rand = rand(0,19);
    $url = $results['articles'][$rand]['url'];
    $headline = $results['articles'][$rand]['title'];

    // Strip off ending hyphen and news org info. This might break some headlines that actually use hyphens...
    $pos = strrpos($headline, '-');
    if (!is_null($pos)) {
      $headline = substr($headline, 0, $pos-1);
    }

    return array('headline'=>$headline,'url'=>$url);

}
