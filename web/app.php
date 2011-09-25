<?php

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

// Define application environment
defined('APP_ENV')
    || define('APP_ENV', (getenv('APP_ENV') ? getenv('APP_ENV') : 'prod'));

use Symfony\Component\HttpFoundation\Request;

setlocale(LC_ALL, 'pt_BR');

$kernel = new AppKernel(APP_ENV, (APP_ENV == 'dev')? true:false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);
$kernel->handle(Request::createFromGlobals())->send();