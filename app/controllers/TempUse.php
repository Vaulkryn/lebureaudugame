<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TempUse
{
    public function roadmap(Request $request, Response $response)
    {
        $loadView = new LoadView($request, $response);
        return $loadView->loadingTempUse('roadmap');
    }

    public function noContent(Request $request, Response $response)
    {
        $loadView = new LoadView($request, $response);
        return $loadView->loadingTempUse('nocontent');
    }
}
