<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\CalculatorController;
use Metinet\Route;
use Metinet\RouteMatcher;

$request = Request::createFromGlobals();

/** @var Route[] $routes */
$routes = [];
$routes[] = new Route(
    'GET',
    '/calculator/addition',
    sprintf('%s::%s', CalculatorController::class, 'addition')
);

$controllers[] = new CalculatorController(16);
$resolver = new \Metinet\ControllerResolver(new RouteMatcher($routes));
$resolver->addController(new CalculatorController(16));
$callable = $resolver->resolve($request);
$response = call_user_func($callable, $request);
$response->send();
