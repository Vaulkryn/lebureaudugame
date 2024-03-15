<?php

namespace app\controllers;

use app\models\DatabaseAuth\Database;
use app\models\ContentManager\ContentControl;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Admin
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
        $contentControl = new ContentControl($db);
        if ($request->getMethod() == 'POST') {
            if (isset($_POST['validatedItem']) || isset($_POST['refusedItem'])) {
                $itemID = isset($_POST['validatedItem']) ? $_POST['validatedItem'] : $_POST['refusedItem'];
                $contentControl->itemControl($itemID);
            } elseif (isset($_POST['acceptedProposal']) || isset($_POST['refusedProposal'])) {
                $proposalID = isset($_POST['acceptedProposal']) ? $_POST['acceptedProposal'] : $_POST['refusedProposal'];
                $contentControl->proposalControl($proposalID);
            }
        } else {
            $loadItems = new ContentControl($db);
            $itemList = $loadItems->getItemList();
            $proposalList = $loadItems->getProposalList();
            $adminLogs = $loadItems->getAdminLogs();
            $dataPackage = [
                'itemList' => $itemList,
                'proposalList' => $proposalList,
                'adminLogs' => $adminLogs
            ];
            $loadView = new LoadView($request, $response, 'controlroom');
            return $loadView->loadingControlRoom($dataPackage);
        }
    }
}
