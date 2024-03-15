<?php

namespace app\models\ContentManager;

use app\models\DatabaseAuth\Database;

class ContentControl
{
    private $db;
    private $time;
    private $date;
    public function __construct(Database $db)
    {
        date_default_timezone_set('Europe/Paris');
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");
        $this->db = $db;
    }

    public function getItemList()
    {
        $itemList = $this->db->prepare('SELECT uploaded_files_pending.*, users.pseudo
            FROM uploaded_files_pending
            INNER JOIN users ON uploaded_files_pending.user_token = users.user_token
            ORDER BY uploaded_files_pending.upload_time, uploaded_files_pending.upload_date ASC');
        $itemList->execute();
        $rowItem = $itemList->rowCount();
        $itemOutput = $itemList->fetchAll();
        return [$itemOutput, $rowItem];
    }

    public function getProposalList()
    {
        $proposalList = $this->db->prepare('SELECT users_proposal.*, users.pseudo
            FROM users_proposal
            INNER JOIN users ON users_proposal.user_token = users.user_token
            ORDER BY users_proposal.proposal_time, users_proposal.proposal_date ASC');
        $proposalList->execute();
        $rowProposal = $proposalList->rowCount();
        $proposalOutput = $proposalList->fetchAll();
        return [$proposalOutput, $rowProposal];
    }

    public function getAdminLogs()
    {
        $adminLogs = $this->db->prepare('SELECT admin_logs.*, users.pseudo
            FROM admin_logs
            INNER JOIN users ON admin_logs.user_token = users.user_token
            ORDER BY admin_logs.ID DESC');
        $adminLogs->execute();
        $adminLogsOutput = $adminLogs->fetchAll();
        return $adminLogsOutput;
    }

    public function itemControl($itemID)
    {
        $ownerItem = NULL;
        $totalUpValidated = 0;
        $totalUpRefused = 0;
        $checkLogs = $this->db->prepare('SELECT users_logs.upload_validated, users_logs.upload_refused FROM users_logs');
        $checkLogs->execute();
        while ($output = $checkLogs->fetch()) {
            $totalUpValidated = $output['upload_validated'];
            $totalUpRefused = $output['upload_refused'];
        }
        $usersLogs = $this->db->prepare('SELECT users.ID AS userID, uploaded_files_pending.ID
        FROM users
        INNER JOIN uploaded_files_pending ON users.user_token = uploaded_files_pending.user_token
        WHERE uploaded_files_pending.ID = :itemID');
        $usersLogs->bindParam(':itemID', $itemID);
        $usersLogs->execute();
        $usersLogsOutput = $usersLogs->fetch();
        if ($usersLogsOutput) {
            $ownerItem = $usersLogsOutput['userID'];
        }
        switch (key($_POST)) {
            case 'validatedItem':
                $totalUpValidated++;
                $mediaStatus = "validated";
                $updateLog = $this->db->prepare('UPDATE users_logs SET upload_validated = :upload_validated WHERE ID = :ID');
                $updateLog->execute(array(
                    'upload_validated' => $totalUpValidated,
                    'ID' => $ownerItem
                ));
                $insertLog = $this->db->prepare("INSERT INTO admin_logs (user_token, media, media_status, logs_time, logs_date)
                SELECT ufp.user_token, CONCAT(ufp.serial_no, '.', ufp.ext), :media_status, :logs_time, :logs_date
                FROM uploaded_files_pending AS ufp
                WHERE ufp.ID = :ID");
                $insertLog->execute(array(
                    'media_status' => $mediaStatus,
                    'logs_time' => $this->time,
                    'logs_date' => $this->date,
                    'ID' => $itemID
                ));
                $transferItem = $this->db->prepare("INSERT INTO uploaded_files (user_token, game_name, category, title, descript, ext, serial_no, file_path, upload_time, upload_date)
                SELECT ufp.user_token, ufp.game_name, ufp.category, ufp.title, ufp.descript, ufp.ext, ufp.serial_no, ufp.file_path, ufp.upload_time, ufp.upload_date
                FROM uploaded_files_pending AS ufp
                WHERE ID = ?");
                $transferItem->execute(array($itemID));
                $DeleteItem = $this->db->prepare("DELETE FROM uploaded_files_pending WHERE ID = ?");
                $DeleteItem->execute(array($itemID));
                header("Refresh:0");
                break;
            case 'refusedItem':
                $totalUpRefused++;
                $mediaStatus = "refused";
                $updateLog = $this->db->prepare('UPDATE users_logs SET upload_refused = :upload_refused WHERE ID = :ID');
                $updateLog->execute(array(
                    'upload_refused' => $totalUpRefused,
                    'ID' => $ownerItem
                ));
                $insertLog = $this->db->prepare("INSERT INTO admin_logs (user_token, media, media_status, logs_time, logs_date)
                SELECT ufp.user_token, CONCAT(ufp.serial_no, '.', ufp.ext), :media_status, :logs_time, :logs_date
                FROM uploaded_files_pending AS ufp
                WHERE ufp.ID = :ID");
                $insertLog->execute(array(
                    'media_status' => $mediaStatus,
                    'logs_time' => $this->time,
                    'logs_date' => $this->date,
                    'ID' => $itemID
                ));
                $DeleteItem = $this->db->prepare("DELETE FROM uploaded_files_pending WHERE ID = ?");
                $DeleteItem->execute(array($itemID));
                header("Refresh:0");
                break;
        }
    }

    public function proposalControl($proposalID)
    {
        switch (key($_POST)) {
            case 'acceptedProposal':
                $proposalStatus = "accepted";
                $insertLog = $this->db->prepare("INSERT INTO admin_logs (user_token, proposal, proposal_status, logs_time, logs_date)
                    SELECT up.user_token, up.proposal_text, :proposal_status, :logs_time, :logs_date
                    FROM users_proposal AS up
                    WHERE up.ID = :ID");
                $insertLog->execute(array(
                    'proposal_status' => $proposalStatus,
                    'logs_time' => $this->time,
                    'logs_date' => $this->date,
                    'ID' => $proposalID
                ));
                $DeleteProposal = $this->db->prepare("DELETE FROM users_proposal WHERE ID = ?");
                $DeleteProposal->execute(array($proposalID));
                header("Refresh:0");
                break;
            case 'refusedProposal':
                $proposalStatus = "refused";
                $insertLog = $this->db->prepare("INSERT INTO admin_logs (user_token, proposal, proposal_status, logs_time, logs_date)
                        SELECT up.user_token, up.proposal_text, :proposal_status, :logs_time, :logs_date
                        FROM users_proposal AS up
                        WHERE up.ID = :ID");
                $insertLog->execute(array(
                    'proposal_status' => $proposalStatus,
                    'logs_time' => $this->time,
                    'logs_date' => $this->date,
                    'ID' => $proposalID
                ));
                $DeleteProposal = $this->db->prepare("DELETE FROM users_proposal WHERE ID = ?");
                $DeleteProposal->execute(array($proposalID));
                header("Refresh:0");
                break;
        }
    }
}
