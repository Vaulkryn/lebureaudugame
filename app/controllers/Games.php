<?php

namespace app\controllers;

use app\models\DatabaseAuth\Database;
use app\models\ContentManager\ContentSelector;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Games
{
    public function index(Request $request, Response $response, $gameURL)
    {
        $dbID = require_once 'app/models/DatabaseAuth/databaseID.php';
        $db = Database::getInstance(
            $dbID['host'],
            $dbID['databaseName'],
            $dbID['loginName'],
            $dbID['password']
        );
        $selector = new ContentSelector($db);
        $gameContent = $selector->selectorOfAll($gameURL['game']);
        $loadView = new LoadView($request, $response, $gameURL['game']);
        return $loadView->loadingGames($gameContent);
    }
}