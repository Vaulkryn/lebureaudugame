<?php

namespace app\models\UserManager;

use app\models\AlertHandler;
use app\models\DatabaseAuth\Database;

class UserUploads
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

    public function screenshotUpload($uploadedFiles, $gameName)
    {
        $maxSize = 157286400;
        $totalMaxSize = 52428800;
        $allowedExt = array('jpg', 'jpeg', 'png', 'svg', 'webp');
        $totaluploads = $_SESSION['total_uploads'];
        if (isset($uploadedFiles['img']) && !empty($gameName)) {
            $imgTotalSize = 0;
            foreach ($uploadedFiles['img'] as $uploadedFile) {
                $imgName = $uploadedFile->getClientFilename();
                $imgSize = $uploadedFile->getSize();
                $imgTotalSize += $uploadedFile->getSize();
                $imgExt = pathinfo($imgName, PATHINFO_EXTENSION);
                if (in_array(strtolower($imgExt), $allowedExt)) {
                    if ($imgSize < $maxSize) {
                        if ($imgTotalSize < $totalMaxSize) {
                            $totaluploads++;
                            $_SESSION['total_uploads'] = $totaluploads;
                            $serialNo = $_SESSION['ID'] . $_SESSION['total_uploads'];
                            $bddPath = "/assets/img/games/screenshots/" . $gameName . '/SerialNo' . $serialNo . '.' . $imgExt;
                            $path = "C:/wamp64/www/lebureaudugame/assets/img/games/screenshots/" . $gameName . "/";
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }
                            $uploadedFile->moveTo($path . 'SerialNo' . $serialNo . '.' . $imgExt);
                            $updateLog = $this->db->prepare('UPDATE users_logs SET total_uploads = :total_uploads WHERE ID = :ID');
                            $updateLog->execute(array(
                                'ID' => $_SESSION['ID'],
                                'total_uploads' => $_SESSION['total_uploads']
                            ));
                            $insertImg = $this->db->prepare('INSERT INTO uploaded_files_pending(user_token, game_name, category, title, descript, ext, serial_no, file_path, upload_time, upload_date)
                                    VALUES (:user_token, :game_name, :category, :title, :descript, :ext, :serial_no, :file_path, :upload_time, :upload_date)');
                            $insertImg->execute(array(
                                'user_token' => $_SESSION['token'],
                                'game_name' => $gameName,
                                'category' => "Screenshot",
                                'title' => NULL,
                                'descript' => NULL,
                                'ext' => $imgExt,
                                'serial_no' => $serialNo,
                                'file_path' => $bddPath,
                                'upload_time' => $this->time,
                                'upload_date' => $this->date
                            ));
                            $this->alertHandler->addAlert("Upload effectué", 'success', 'upload_img');
                        } else {
                            $this->alertHandler->addAlert("Taille totale dépassée => 50Mo maximum", 'error', 'upload_img');
                        }
                    } else {
                        $this->alertHandler->addAlert("Une image dépasse la taille maximale autorisé.", 'error', 'upload_img');
                    }
                } else {
                    $this->alertHandler->addAlert("Une image n'a pas le format autorisé.", 'error', 'upload_img');
                }
            }
        } else {
            $this->alertHandler->addAlert("Choississez les fichiers et le jeu en question", 'error', 'upload_img');
        }
    }

    public function videoUpload()
    {
        $maxSize = 1073741824;
        $allowedExt = array('mp4', 'avi', 'webm', 'mkv', 'mov');
        $totaluploads = $_SESSION['total_uploads'];
        if (!empty($_FILES['video']['name'])) {
            if (!empty($_POST['game_name'])) {
                if (!empty($_POST['video_category'])) {
                    if (!empty($_POST['title'])) {
                        $gameName = $_POST['game_name'];
                        $videoTempName = $_FILES['video']['tmp_name'];
                        $videoName = $_FILES['video']['name'];
                        $videoSize = $_FILES['video']['size'];
                        $videoCategory = $_POST['video_category'];
                        $videoTitle = htmlspecialchars($_POST['title']);
                        $videoDescript = htmlspecialchars($_POST['description'] ?? null);
                        $videoExt = pathinfo($videoName, PATHINFO_EXTENSION);
                        if (in_array(strtolower($videoExt), $allowedExt)) {
                            if ($videoSize < $maxSize) {
                                $totaluploads++;
                                $_SESSION['total_uploads'] = $totaluploads;
                                $serialNo = $_SESSION['ID'] . $_SESSION['total_uploads'];
                                $bddPath = "/assets/video/" . $gameName . '/SerialNo' . $serialNo . '.' . $videoExt;
                                $path = "C:/wamp64/www/lebureaudugame/assets/video/" . $gameName . "/";
                                if (!file_exists($path)) {
                                    mkdir($path, 0777, true);
                                }
                                if (move_uploaded_file($videoTempName, $path . 'SerialNo' . $serialNo . '.' . $videoExt)) {
                                    $updateLog = $this->db->prepare('UPDATE users_logs SET total_uploads = :total_uploads WHERE ID = :ID');
                                    $updateLog->execute(array(
                                        'ID' => $_SESSION['ID'],
                                        'total_uploads' => $_SESSION['total_uploads']
                                    ));
                                    $insertVideo = $this->db->prepare('INSERT INTO uploaded_files_pending(user_token, game_name, category, title, descript, ext, serial_no, file_path, upload_time, upload_date)
                                    VALUES (:user_token, :game_name, :category, :title, :descript, :ext, :serial_no, :file_path, :upload_time, :upload_date)');
                                    $insertVideo->execute(array(
                                        'user_token' => $_SESSION['token'],
                                        'game_name' => $gameName,
                                        'category' => $videoCategory,
                                        'title' => $videoTitle,
                                        'descript' => $videoDescript,
                                        'ext' => $videoExt,
                                        'serial_no' => $serialNo,
                                        'file_path' => $bddPath,
                                        'upload_time' => $this->time,
                                        'upload_date' => $this->date
                                    ));
                                    $this->alertHandler->addAlert("Upload Effectué", 'success', 'upload_video');
                                } else {
                                    $this->alertHandler->addAlert("Erreur transfert", 'error', 'upload_video');
                                }
                            } else {
                                $this->alertHandler->addAlert("La vidéo dépasse la taille maximum", 'error', 'upload_video');
                            }
                        } else {
                            $this->alertHandler->addAlert("Format non autorisé", 'error', 'upload_video');
                        }
                    } else {
                        $this->alertHandler->addAlert("Veuillez donner un titre", 'error', 'upload_video');
                    }
                } else {
                    $this->alertHandler->addAlert("Sélectionnez la catégorie", 'error', 'upload_video');
                }
            } else {
                $this->alertHandler->addAlert("Sélectionnez le jeu en question", 'error', 'upload_video');
            }
        } else {
            $this->alertHandler->addAlert("Sélectionnez le fichier", 'error', 'upload_video');
        }
    }

    public function uploadsPending()
    {
        $userToken = $_SESSION['token'];
        $query = $this->db->prepare('SELECT * FROM uploaded_files_pending WHERE user_token = ?');
        $query->execute(array($userToken));
        $row = $query->rowCount();
        $queryOutput = $query->fetchAll();
        return [$queryOutput, $row];
    }
}
