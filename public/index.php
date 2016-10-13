<?php
use Zend\Expressive\Application;
use Zend\Expressive\Helper;
use App\Action;

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(Application::class);

// Pipeline
$app->pipe(Helper\ServerUrlMiddleware::class);
// Here the custom middlewares

// Routing and dispatch middleware
$app->pipeRoutingMiddleware();
$app->pipe(Helper\UrlHelperMiddleware::class);
$app->pipeDispatchMiddleware();

// Routes
$app->get('/', Action\HomePageAction::class, 'home');
$app->get('/api/ping', Action\PingAction::class, 'api.ping');
$app->get('/speaker[/{id:\d+}]', Action\SpeakerAction::class, 'speaker');
$app->get('/talk[/{id:\d+}]', Action\TalkAction::class, 'talk');
$app->get('/schedule', Action\ScheduleAction::class, 'schedule');

$app->run();
