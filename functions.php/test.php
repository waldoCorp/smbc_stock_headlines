<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

require_once __DIR__ . '/get_headline.php';
require_once __DIR__ . '/get_adjective.php';

$headline = get_adjective();

var_dump($headline);
