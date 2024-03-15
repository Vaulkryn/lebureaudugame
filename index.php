<?php

require 'vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\controllers\{
    Home,
    Admin,
    User,
    Games,
    TempUse,
    NotFound,
};

function sessionControl()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['token'])) {
        $protectedRoutes = array(
            '/user/uploadVideo',
            '/user/uploadImg',
            '/user/enAttente',
            '/user/changerAvatar',
            '/user/changerPseudo',
            '/user/changerMdp',
            '/user/proposer'
        );
        $currentRoute = $_SERVER['REQUEST_URI'];
        if (in_array($currentRoute, $protectedRoutes)) {
            header('Location: http://lebureaudugame');
            exit;
        }
    }
}
sessionControl();

$route = AppFactory::create();
$route->get('/', Home::class . ':index');
$route->get('/roadmap', TempUse::class . ':roadmap');
$route->get('/nocontent', TempUse::class . ':noContent');
$route->get('/controlroom', Admin::class . ':index');/*Pour empêcher l'accès, créer un système un peu plus sophistiqué qu'avec un .htaccess*/
$route->post('/controlroom', Admin::class . ':index');
$route->group('/games', function (RouteCollectorProxy $group) {
    $group->get('/{game}', Games::class . ':index');
});

$route->group('/user', function (RouteCollectorProxy $group) {
    $userHandler = function (Request $request, Response $response, $method) {
        $user = new User($request, $response);
        return $user->$method($request, $response);
    };
    $routes = [
        's\'inscrire' => 'register',
        'uploadVideo' => 'uploadVideo',
        'uploadImg' => 'uploadImg',
        'enAttente' => 'uploadsPending',
        'changerAvatar' => 'changeAvatar',
        'changerPseudo' => 'changePseudo',
        'changerMdp' => 'changePassword',
        'nouveauMdp' => 'newPassword',
        'proposer' => 'proposal',
        'déconnexion' => 'logout',
    ];
    foreach ($routes as $path => $method) {
        $group->get('/' . $path, function (Request $request, Response $response) use ($userHandler, $method) {
            return $userHandler($request, $response, $method);
        });
    }
});

$route->group('/postRequest', function (RouteCollectorProxy $group) {
    $userHandler = function (Request $request, Response $response, $method) {
        $user = new User($request, $response);
        return $user->$method();
    };
    $routes = [
        'register' => 'register',
        'uploadImg' => 'uploadImg',
        'uploadVideo' => 'uploadVideo',
        'changeAvatar' => 'changeAvatar',
        'changePseudo' => 'changePseudo',
        'changePassword' => 'changePassword',
        'proposal' => 'proposal',
        'login' => 'login'
    ];
    foreach ($routes as $path => $method) {
        $group->post('/' . $path, function (Request $request, Response $response) use ($userHandler, $method) {
            return $userHandler($request, $response, $method);
        });
    }
});

$route->add(function ($request, $handler) {
    try {
        return $handler->handle($request);
    } catch (HttpNotFoundException) {
        $notFound = new NotFound('Erreur 404:</br>Cette page n\'existe pas');
        return $notFound($request);
    }
});
$route->run();
