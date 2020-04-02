<?php
error_reporting(-1);
ini_set('display_errors','On');
require_once __DIR__.'/vendor/autoload.php';

$loader = new Mustache_Loader_FilesystemLoader(__DIR__.'/templates');
$arrayLoader = new Mustache_Loader_ArrayLoader(
  [
    'index'=>'test template '
  ]
);
$realLoader = new Mustache_Loader_CascadingLoader([
  $loader,
  $arrayLoader
]);

$partialsLoader = new Mustache_Loader_FilesystemLoader(__DIR__.'/partials');
$mustache = new Mustache_Engine(
  [
    'loader'=>$realLoader,
    'partials_loader'=>$partialsLoader,
    'cache'=>__DIR__.'/cache',
    'helpers'=>[
      'lower'=>function($text){
        return strtolower($text);
      },
      '!!'=>function($text){
        return $text.'!!';
      }
    ]
  ]
);

class View{
  public $text = 'World';
  public $isTrue = true;
  public $data = [
    'foo'=>[
      'bar'=>'test'
    ]
  ];

  public $html = '<marquee>WHOOO</marquee>';
  private $invalidArray = [
    2=>'test1',
    5=>'test1',
    1=>'test1'
  ];
  public function zahlen(){
    return range(1,20);
  }
  public function invliadArray(){
    return array_values($this->invalidArray);
  }
}
$view = new View();

echo $mustache->render('index',$view);
