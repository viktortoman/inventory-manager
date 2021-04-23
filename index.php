<?php
require 'app/bootstrap.php';

$start = new \App\Helpers\Utils();
$startResult = $start->start();

$start->pre($startResult);
die;