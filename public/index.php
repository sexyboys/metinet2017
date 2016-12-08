<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\Controllers\CalculatorController;
use Metinet\Controllers\ConferenceController;
use Metinet\Routing\Route;
use Metinet\Routing\RouteMatcher;
use Metinet\ControllerResolver;
use Metinet\Config\Configuration;
use Metinet\Config\RoutesCsvLoader;
use Metinet\Config\ChainLoader;
use Metinet\Config\YamlLoader;
use Metinet\Controllers\ErrorController;
use Metinet\ExceptionHandler;

$request = Request::createFromGlobals();

$loader = new ChainLoader([
    new RoutesCsvLoader(__DIR__ . '/../config/routes.csv'),
    new YamlLoader(__DIR__ . '/../config/config.yml'),
]);

$configuration = new Configuration($loader);
$routes = [];
foreach ($configuration->getSection('routes') as $route) {
    $routes[] = new Route($route['method'], $route['path'], $route['action']);
}

$base = $configuration->getSection('parameters')['calculator']['base'];
$controllers[] = new CalculatorController($base);
$controllers[] = new ConferenceController();
$resolver = new ControllerResolver(new RouteMatcher($routes));
foreach ($controllers as $controller) {
    $resolver->addController($controller);
}
try {
    $callable = $resolver->resolve($request);
    $response = call_user_func($callable, $request);
    if (!$response instanceof Response) {
        throw new RuntimeException('Action must return a Response object');
    }
} catch (Throwable $e) {
    $errorController = new ErrorController();
    $exceptionHandler = new ExceptionHandler($errorController);
    $callable = $exceptionHandler->handle($e);
    $response = call_user_func($callable, $request);
}
$response->send();
