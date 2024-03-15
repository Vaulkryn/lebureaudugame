<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class NotFound
{
    private $info;

    public function __construct($info = '')
    {
        $this->info = $info;
    }

    public function __invoke(): ResponseInterface
    {
        $response = new Response();
        $response = $response->withStatus(404);
        $style = '
        <style>
        body {
            font-family: Verdana;
            background-color: #272727;
            text-align: center;
            padding: 2rem;
        }
        .error-info {
            font-size: 24px;
            font-weight: bold;
            color: darkorange;
        }
        </style>';
        $response->getBody()->write($style . '<div class="error-info">' . $this->info . '</div>');
        return $response;
    }
}
