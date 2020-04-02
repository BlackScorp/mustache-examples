<?php
error_reporting(-1);
ini_set('display_errors','On');
require_once __DIR__.'/../vendor/autoload.php';

$loader = new Mustache_Loader_FilesystemLoader(__DIR__.'/templates');
$partialsLoader = new Mustache_Loader_FilesystemLoader(__DIR__.'/templates/partials');
$layoutLoader = new Mustache_Loader_FilesystemLoader(__DIR__.'/templates/layouts');
$cascadingLoader = new Mustache_Loader_CascadingLoader([$partialsLoader,$layoutLoader]);
$mustache = new Mustache_Engine(
  [
    'loader'=>$loader,
    'partials_loader'=>$cascadingLoader,
  ]
);

function randomString($maxLength = 6){
  $string = md5(random_int(0,time()));
  return$randomString = substr($string,random_int(0,strlen($string)-$maxLength),$maxLength);
}

$dataArray = [];
for($i = 0;$i<10;$i++){
  $dataArray[] = [
    'name'=>randomString(),
    'someId'=>random_int(0,time())
  ];
}
$renderData = [
  'dataArray'=>$dataArray,
  'rowTemplate'=>file_get_contents(__DIR__.'/templates/partials/row.mustache')
];
echo $mustache->render('index',$renderData );
