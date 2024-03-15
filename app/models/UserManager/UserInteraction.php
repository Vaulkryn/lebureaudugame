<?php

namespace app\models\UserManager;

use app\models\AlertHandler;
use app\models\DatabaseAuth\Database;

class UserInteraction
{
    private $time;
    private $date;
    private $db;
    private $alertHandler;
    public function __construct(Database $db, AlertHandler $alertHandler)
    {
        date_default_timezone_set('Europe/Paris');
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");
        $this->db = $db;
        $this->alertHandler = $alertHandler;
    }

    public function sendComment()
    {
        if (isset($_POST['comment'])) {
            if (!empty($_POST['comment'])) {
                if (isset($_SESSION['user'])) {
                    $identifier = $_POST['identifier'];
                    $comment = htmlspecialchars($_POST['comment']);
                    $insertComment = $this->db->prepare('INSERT INTO video_comments (user_token, identifier, comment, comment_time, comment_date)
                    VALUES (:user_token, :identifier, :comment, :comment_time, :comment_date)');
                    $insertComment->execute(array(
                        'user_token' => $_SESSION['token'],
                        'identifier' => $identifier,
                        'comment' => $comment,
                        'comment_time' => $this->time,
                        'comment_date' => $this->date
                    ));
                    $this->alertHandler->addAlert("Commentaire envoyé", 'success', 'send_comment');
                } else {
                    $this->alertHandler->addAlert("Veuillez vous connecter pour écrire un commentaire", 'success', 'send_comment');
                }
            }
        }
    }

    public function sendProposal()
    {
        if (!empty($_POST['proposal_text'])) {
            $proposal = $_POST['proposal_text'];
            $insertPropos = $this->db->prepare('INSERT INTO users_proposal (user_token, proposal_text, proposal_time, proposal_date)
        VALUES (:user_token, :proposal_text, :proposal_time, :proposal_date)');
            $insertPropos->execute(array(
                'user_token' => $_SESSION['token'],
                'proposal_text' => $proposal,
                'proposal_time' => $this->time,
                'proposal_date' => $this->date
            ));
            $this->alertHandler->addAlert("Message envoyé !", 'success', 'send_proposal');
        }
    }
}
