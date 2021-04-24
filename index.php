<?php
require 'app/bootstrap.php';

$start = new \App\Helpers\Utils();
$startResult = $start->start();

dump($startResult);
die;