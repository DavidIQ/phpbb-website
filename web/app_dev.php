<?php
ini_set('display_errors', 1);

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (!in_array(@$_SERVER['HTTP_X_FORWARDED_FOR'], array(
        '176.26.177.168',
    ))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

\QafooLabs\Profiler::startDevelopment('aeyooC3aa5eighio');

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
Debug::enable();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

\QafooLabs\Profiler::setTransactionName($request->attributes->get('_controller', 'notfound'));

$kernel->terminate($request, $response);
