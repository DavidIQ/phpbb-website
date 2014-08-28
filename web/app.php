<?php

use Symfony\Component\HttpFoundation\Request;

umask(0000);

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance
// Change 'sf2' by the prefix you want in order to prevent key conflict with another application
/*
$loader = new ApcClassLoader('sf2', $loader);
$loader->register(true);
*/

require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

\QafooLabs\Profiler::start('VTABbprWKJuSlnR9');

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

\QafooLabs\Profiler::setTransactionName($request->attributes->get('_controller', 'notfound'));

$kernel->terminate($request, $response);
