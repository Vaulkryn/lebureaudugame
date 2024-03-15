<?php

namespace app\models\UserManager;

use app\models\AlertHandler;
use app\models\DatabaseAuth\Database;

class UserAuth
{
    private $db;
    private $alertHandler;
    public function __construct(Database $db, AlertHandler $alertHandler)
    {
        $this->db = $db;
        $this->alertHandler = $alertHandler;
    }

    public function loginTheUser($email, $password)
    {
        $useremail = htmlspecialchars($email);
        $userpassword = htmlspecialchars($password);
        $useremail = strtolower($useremail);
        $query = $this->db->prepare('SELECT ID, email, pseudo, passwd, avatar_path, user_token FROM users WHERE email = ?');
        $query->execute(array($useremail));
        $data = $query->fetch();
        $row = $query->rowCount();
        if ($row > 0) {
            if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
                if (password_verify($userpassword, $data['passwd'])) {
                    $userID = $data['ID'];
                    $queryLogs = $this->db->prepare('SELECT total_uploads FROM users_logs WHERE ID = ?');
                    $queryLogs->execute(array($userID));
                    $dataLogs = $queryLogs->fetch();
                    $rowLogs = $queryLogs->rowCount();
                    if ($rowLogs >= 0) {
                        $_SESSION['ID'] = $data['ID'];
                        $_SESSION['user'] = $data['pseudo'];
                        $_SESSION['avatar'] = $data['avatar_path'];
                        $_SESSION['token'] = $data['user_token'];
                        $_SESSION['total_uploads'] = $dataLogs['total_uploads'];
                        $this->alertHandler->addAlert("", 'success', 'login');
                    }
                } else {
                    $this->alertHandler->addAlert("Mot de passe incorrect", 'error', 'login');
                }
            } else {
                $this->alertHandler->addAlert("Email incorrect", 'error', 'login');
            }
        } else {
            $this->alertHandler->addAlert("Ce compte n'existe pas", 'error', 'login');
        }
    }
}
