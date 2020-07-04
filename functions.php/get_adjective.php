<?php

/**
 * Function to get a random adjective from our list
 *
 * Usage:
 * require_once './get_adjective.php'
 *
 * $adjective = get_headline();
 *
 * No params.
 *
 * Return:
 * array('adjective'=>string,'positive'=>boolean)
 * The boolean is to indicate if this is a 'positive' adjective (true) or not (false)
 *
**/

function get_adjective() {

  require __DIR__ . '/get_market_trend.php';
  $up = get_market_trend();

  if ($up) {
    $file = __DIR__ . '/../data/adjectives-positive.txt';
  } else {
    $file = __DIR__ . '/../data/adjectives-negative.txt';
  }

  $adjective_file = new SplFileObject($file);
  $adjective_file->seek(0); // First line of file is maximum possible lines
  $max_lines = trim($adjective_file->current());

  $rand = rand(2,$max_lines);

  $adjective_file->seek($rand);
  $adjective = trim($adjective_file->current());

  $resp = array('adjective'=>$adjective, 'positive'=>$bool);

  return $resp;
}
