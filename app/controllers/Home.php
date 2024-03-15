<?php

namespace app\controllers;

use app\models\DatabaseAuth\Database;
use app\models\ContentManager\ContentSelector;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Home
{
    public function index(Request $request, Response $response)
    {
        $dbID = require_once 'app/models/DatabaseAuth/databaseID.php';
        $db = Database::getInstance(
            $dbID['host'],
            $dbID['databaseName'],
            $dbID['loginName'],
            $dbID['password']
        );
        $selector = new ContentSelector($db);
        $screenshots = $selector->shuffledImg(28);
        $loadView = new LoadView($request, $response, 'home');
        return $loadView->loadingHome($screenshots);
    }
}
