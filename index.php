<?php

use core\components\Url;
use core\exceptions\NotFoundHttpException;

function __autoload($class)
{
    $class = str_replace('\\', '/', $class);
    require_once $class . '.php';
}

$controller = Url::getRouteSegment(0);
$action = Url::getRouteSegment(1);

if (is_null($controller)) {
    $controller = 'MainController';
} else {
    $controller = ucfirst(strtolower($controller)) . 'Controller';
}

if (is_null($action)) {
    $action = 'actionIndex';
} else {
    $action = 'action' . ucfirst(strtolower($action));
}

try {
    if (!file_exists('app/controllers/' . $controller . '.php')) {
        throw new NotFoundHttpException('Page not Found');
    }
    $controller = 'app\controllers\\' . $controller;
    $controller = new $controller();

    if (!method_exists($controller, $action)) {
        throw new NotFoundHttpException('Page not Found');
    }

    $output = $controller->$action();
    echo $output;
} catch (NotFoundHttpException $e) {
    header('HTTP/1.1 404 Not Found');
    echo $e->getMessage();

} catch (Exception $e) {
    echo 'Error:' . $e->getMessage();
}