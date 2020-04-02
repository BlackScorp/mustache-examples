<?php
error_reporting(-1);
ini_set('display_errors','On');

function randomString($maxLength = 6){
  $string = md5(random_int(0,time()));
  return$randomString = substr($string,random_int(0,strlen($string)-$maxLength),$maxLength);
}

$data = [
  'name'=>randomString(),
  'someId'=>random_int(0,time())
];

header('Content-Type:application/json');
echo json_encode($data);
