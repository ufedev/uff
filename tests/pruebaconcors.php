<?php
include __DIR__ . "/vendor/autoload.php";

use Ufe\Router;
use Ufe\Cors;
use Controllers\Control;


$whiteList = ["http://127.0.0.1:4000"];

Cors::setCors($whiteList);

$router = new Router();

$router->full("/", function ($req, $res) {

    Control::index($req, $res);
    Control::hola($req, $res);
    Control::show($req, $res);
    Control::del($req, $res);
}, ["GET", "POST", "PUT", "DELETE"]);

$router->listen();
