<?php

declare(strict_types=1);

namespace App;

include __DIR__ . "/../../vendor/autoload.php";
include "functions.php";

use Framework\App;


$app = new App();

$app->get('//');
$app->get("/");
$app->get('/about/function');
$app->get("/about/function/");
$app->get("about/function");


return $app;
