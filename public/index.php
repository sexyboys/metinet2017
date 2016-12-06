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
use Metinet\ControllerResolver;

$request = Request::createFromGlobals();

/** @var Route[] $routes */
$routes = [];
$routes[] = new Route(
    'GET',
    '/calculator/addition',
    sprintf('%s::%s', CalculatorController::class, 'addition')
);
$routes[] = new Route(
    'GET',
    '/calculator/subtraction',
    sprintf('%s::%s', CalculatorController::class, 'subtraction')
);

$controllers[] = new CalculatorController(16);
$resolver = new ControllerResolver(new RouteMatcher($routes));
$resolver->addController(new CalculatorController(16));
$callable = $resolver->resolve($request);
$response = call_user_func($callable, $request);
$response->send();
