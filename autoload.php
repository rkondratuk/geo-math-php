<?php
require_once 'vendor/autoload.php';

$rootPath = __DIR__;
$autoloadNamespaces = ['PhpGeoMath' => $rootPath.'/src/'];

spl_autoload_register(function ($className) use ($autoloadNamespaces) {
    $namespaceNodes = explode('\\', $className, 2);

    if (count($namespaceNodes) < 2 || !array_key_exists($namespaceNodes[0], $autoloadNamespaces)) {
        return;
    }

    include $autoloadNamespaces[$namespaceNodes[0]]
        .str_replace('\\', '/', $namespaceNodes[1]).'.php';
});
