<?php

use App\Helpers\ConfigHelper;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/constants.php';

$config = require_once __DIR__ . '/../config/app.php';

$env = ConfigHelper::get('environment');

if($env == 'dev') {
    $envConfig = require_once __DIR__ . '/../config/local/config.php';
    require_once __DIR__ . '/../config/local/constants.php';
} else {
    $envConfig = require_once __DIR__ . '/../config/prod/config.php';
    require_once __DIR__ . '/../config/prod/constants.php';
}
if(empty($app))
	$app = new \Main\App();

/**
 * @var \Main\Persistent $persistent
 * @description Change persistent type in config/app.php
 */
$persistent = $app->getContainer()->get('persistent');

if(ConfigHelper::get('http_cache')) {
    $app->add(new \Slim\HttpCache\Cache('public', 86400));
}

include_once __DIR__ . '/../app/Routes/web.php';
include_once __DIR__ . '/../app/Routes/api.php';
include_once __DIR__ . '/../app/Routes/admin.php';


$app->run();
