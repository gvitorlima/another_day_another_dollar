<?php

$globalFunctions = __DIR__ . '/../utils';
$globalFunctions = glob($globalFunctions . '/*.php');

foreach ($globalFunctions as $key => $value) {
  include $value;
}
