<?php
define('APP', 1);
require_once "app.php";
$config = require_once "config.php";

$app = new Application($config);
$app->run();
