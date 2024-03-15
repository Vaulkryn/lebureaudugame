<?php

namespace app\models\UserManager;

use app\models\AlertHandler;
use app\models\DatabaseAuth\Database;

class UserSettings
{
    private $db;
    private $alertHandler;
    public function __construct(Database $db, AlertHandler $alertHandler)
    {
        $this->db = $db;
        $this->alertHandler = $alertHandler;
    }

    public function changeAvatar()
    {
        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
            $maxSize = 2097152;
            $availableFormat = array('jpg', 'jpeg', 'png', 'svg', 'gif');
            if ($_FILES['avatar']['size'] <= $maxSize) {
                $formatUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if (in_array($formatUpload, $availableFormat)) {
                    $bddPath = "/assets/img/avatar/" . $_SESSION['user'] . '.' . $formatUpload;
                    $path = "C:/wamp64/www/lebureaudugame/assets/img/avatar/" . $_SESSION['user'] . '.' . $formatUpload;
                    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
                    if ($result) {
                        $insertAvatar = $this->db->prepare('UPDATE users SET avatar_path = :avatar_path WHERE ID = :ID');
                        $insertAvatar->execute(array(
                            'avatar_path' => $bddPath,
                            'ID' => $_SESSION['ID']
                        ));
                        $this->alertHandler->addAlert("Changement effectué !", 'success', 'change_avatar');
                    } else {
                        $this->alertHandler->addAlert("Erreur lors de l'importation", 'error', 'change_avatar');
                    }
                } else {
                    $this->alertHandler->addAlert("Format non valide", 'error', 'change_avatar');
                }
            } else {
                $this->alertHandler->addAlert("Image trop volumineuse - 2Mo maximum", 'error', 'change_avatar');
            }
        } else {
            $this->alertHandler->addAlert("Aucune image sélectionnée", 'error', 'change_avatar');
        }
    }

    public function changePseudo()
    {
        if (!empty($_POST['currentpseudo']) && !empty($_POST['newpseudo']) && !empty($_POST['newpseudo_repeat'])) {
            $currentpseudo = htmlspecialchars($_POST['currentpseudo']);
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $newpseudo_repeat = htmlspecialchars($_POST['newpseudo_repeat']);
            $currentpseudo = strtolower($currentpseudo);
            $newpseudo = strtolower($newpseudo);
            $newpseudo_repeat = strtolower($newpseudo_repeat);
            $queryPseudo = $this->db->prepare('SELECT email, pseudo, passwd FROM users WHERE pseudo = ?');
            $queryPseudo->execute(array($newpseudo));
            $rowPseudo = $queryPseudo->rowCount();
            $checkpseudo = $this->db->prepare('SELECT pseudo FROM users WHERE ID = :ID');
            $checkpseudo->execute(array(
                ':ID' => $_SESSION['ID']
            ));
            $datapseudo = $checkpseudo->fetch();
            if ($rowPseudo == 0) {
                if ($currentpseudo == $datapseudo['pseudo']) {
                    if ($newpseudo == $newpseudo_repeat) {
                        $update = $this->db->prepare('UPDATE users SET pseudo = :pseudo WHERE ID = :ID');
                        $update->execute(array(
                            'pseudo' => $newpseudo,
                            'ID' => $_SESSION['ID']
                        ));
                        $this->alertHandler->addAlert("Le pseudo a été changé avec succès", 'success', 'change_pseudo');
                    } else {
                        $this->alertHandler->addAlert("Les pseudo ne correspondent pas", 'error', 'change_pseudo');
                    }
                } else {
                    $this->alertHandler->addAlert("Le pseudo n'a pas changé", 'error', 'change_pseudo');
                }
            } else {
                $this->alertHandler->addAlert("Ce pseudo est déjà pris", 'error', 'change_pseudo');
            }
        }
    }

    public function changePassword()
    {
        if (!empty($_POST['currentpasswd']) && !empty($_POST['newpasswd']) && !empty($_POST['newpasswd-repeat'])) {
            $currentpasswd = htmlspecialchars($_POST['currentpasswd']);
            $newpasswd = htmlspecialchars($_POST['newpasswd']);
            $newpasswd_repeat = htmlspecialchars($_POST['newpasswd-repeat']);
            $checkpasswd = $this->db->prepare('SELECT passwd FROM users WHERE ID = :ID');
            $checkpasswd->execute(array(
                ':ID' => $_SESSION['ID']
            ));
            $datapasswd = $checkpasswd->fetch();
            if (password_verify($currentpasswd, $datapasswd['passwd'])) {
                if ($newpasswd == $newpasswd_repeat) {
                    $cost = ['cost' => 12];
                    $newpasswd = password_hash($newpasswd, PASSWORD_BCRYPT, $cost);
                    $update = $this->db->prepare('UPDATE users SET passwd = :passwd WHERE ID = :ID');
                    $update->execute(array(
                        'passwd' => $newpasswd,
                        'ID' => $_SESSION['ID']
                    ));
                    $this->alertHandler->addAlert("Le mot de passe a été changé avec succès", 'success', 'change_password');
                } else {
                    $this->alertHandler->addAlert("Les mots de passe ne correspondent pas", 'error', 'change_password');
                }
            } else {
                $this->alertHandler->addAlert("Le mot de passe actuel est incorrect", 'error', 'change_password');
            }
        }
    }

    public function registration($email, $pseudo, $password, $password_repeat)
    {
        $useremail = htmlspecialchars($email);
        $userpseudo = htmlspecialchars($pseudo);
        $userpassword = htmlspecialchars($password);
        $userpassword_repeat = htmlspecialchars($password_repeat);
        $queryMail = $this->db->prepare('SELECT email, pseudo, passwd FROM users WHERE email = ?');
        $queryMail->execute(array($useremail));
        $rowMail = $queryMail->rowCount();
        $queryPseudo = $this->db->prepare('SELECT email, pseudo, passwd FROM users WHERE pseudo = ?');
        $queryPseudo->execute(array($userpseudo));
        $rowPseudo = $queryPseudo->rowCount();
        $useremail = strtolower($useremail);
        $userpseudo = strtolower($userpseudo);
        if ($rowMail == 0) {
            if ($rowPseudo == 0) {
                if (strlen($userpseudo) <= 18) {
                    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
                        if ($userpassword === $userpassword_repeat) {
                            $cost = ['cost' => 12];
                            $userpassword = password_hash($userpassword, PASSWORD_BCRYPT, $cost);
                            $usertoken = bin2hex(random_bytes(12));
                            $insert = $this->db->prepare('INSERT INTO users(email, pseudo, passwd, avatar_path, user_token) VALUES (:email, :pseudo, :passwd, :avatar_path, :user_token)');
                            $insert->execute(array(
                                'email' => $useremail,
                                'pseudo' => $userpseudo,
                                'passwd' => $userpassword,
                                'avatar_path' => NULL,
                                'user_token' => $usertoken
                            ));
                            $insertLog = $this->db->prepare('INSERT INTO users_logs(total_uploads, upload_validated, upload_refused) VALUES (:total_uploads, :upload_validated, :upload_refused)');
                            $insertLog->execute(array(
                                'total_uploads' => NULL,
                                'upload_validated' => NULL,
                                'upload_refused' => NULL
                            ));
                            $this->alertHandler->addAlert("Inscription réussie", 'success', 'registration');
                        } else {
                            $this->alertHandler->addAlert("Les mots de passes ne correspondent pas", 'error', 'registration');
                        }
                    } else {
                        $this->alertHandler->addAlert("Email invalide", 'error', 'registration');
                    }
                } else {
                    $this->alertHandler->addAlert("Pseudo de 18 caractères maximum", 'error', 'registration');
                }
            } else {
                $this->alertHandler->addAlert("Ce pseudo est déjà pris", 'error', 'registration');
            }
        } else {
            $this->alertHandler->addAlert("Un compte avec cet email existe déjà", 'error', 'registration');
        }
    }
}
