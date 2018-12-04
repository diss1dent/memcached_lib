<?php

header("Content-type: text/html; charset=utf-8");

spl_autoload_register(function ($class) {
    include '../' . str_replace('\\', '/', $class) . '.php';
});

use src\components\Memcache\Memcache;
use src\components\Render\Render;

$memcache = new Memcache();
$render = new Render();
$tplFile = __DIR__.'./../src/views/memcache.php';

echo $render->renderPhpFile($tplFile, ['memcache' => $memcache]);
