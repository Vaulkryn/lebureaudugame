<?php

namespace app\models\ContentManager;

use app\models\DatabaseAuth\Database;
use PDO;

class ContentSelector
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function selectorOfAll($gameName)
    {
        $selectAll = $this->db->prepare('SELECT uploaded_files.*, users.pseudo, users.avatar_path
        FROM uploaded_files
        INNER JOIN users ON uploaded_files.user_token = users.user_token
        WHERE game_name = :game_name');
        $selectAll->bindParam(':game_name', $gameName, PDO::PARAM_STR);
        $selectAll->execute();
        return $selectAll->fetchAll();
    }

    public function shuffledImg($limit)
    {
        $screenshotList = $this->db->prepare('SELECT uploaded_files.file_path, users.pseudo
        FROM uploaded_files
        INNER JOIN users ON uploaded_files.user_token = users.user_token WHERE ext IN ("jpg", "jpeg", "png", "svg", "webp")');
        $screenshotList->execute();
        $screenshotListOutput = $screenshotList->fetchAll();
        shuffle($screenshotListOutput);
        return [$limit, $screenshotListOutput];
    }
}
