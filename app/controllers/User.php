<?php

namespace app\controllers;

use app\models\AlertHandler;
use app\models\DatabaseAuth\Database;
use app\models\UserManager\UserAuth;
use app\models\UserManager\UserInteraction;
use app\models\UserManager\UserUploads;
use app\models\UserManager\UserSettings;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class User
{
    private $db;
    private $request;
    private $response;
    private $loadView;
    private $style;
    private $badAlert;
    private $goodAlert;
    private $redirect;
    public function __construct(Request $request, Response $response)
    {
        $dbID = require 'app/models/DatabaseAuth/databaseID.php';
        $this->request = $request;
        $this->response = $response;
        $this->loadView = new LoadView($request, $response);
        $this->db = Database::getInstance(
            $dbID['host'],
            $dbID['databaseName'],
            $dbID['loginName'],
            $dbID['password']
        );
        $this->style = '
        <style>
        body {
            font-family: Verdana;
            background-color: #272727;
            text-align: center;
            padding: 2rem;
        }
        .alert-info {
            font-size: 24px;
            font-weight: bold;
        }
        </style>';
        $this->badAlert = '
        <style>
        .alert-info {
            color: #ab0000;
        }
        </style>';
        $this->goodAlert = '
        <style>
        .alert-info {
            color: green;
        }
        </style>';
        $this->redirect = '<meta http-equiv="refresh" content="3;url=http://lebureaudugame">';
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $email =  $this->request->getParsedBody()['email'] ?? '';
            $pseudo =  $this->request->getParsedBody()['pseudo'] ?? '';
            $password =  $this->request->getParsedBody()['password'] ?? '';
            $password_repeat =  $this->request->getParsedBody()['password-repeat'] ?? '';
            $alertHandler = new AlertHandler();
            $register = new UserSettings($this->db, $alertHandler);
            $register->registration($email, $pseudo, $password, $password_repeat);
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'registration') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('register');
        }
    }

    public function uploadImg()
    {
        if ($this->request->getMethod() === 'POST') {
            $uploadedFiles = $this->request->getUploadedFiles();
            $gameName =  $this->request->getParsedBody()['game_name'] ?? '';
            $alertHandler = new AlertHandler();
            $upload = new UserUploads($this->db, $alertHandler);
            $upload->screenshotUpload($uploadedFiles, $gameName);
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'upload_img') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('upload_screenshot');
        }
    }

    public function uploadVideo()
    {
        if ($this->request->getMethod() === 'POST') {
            $alertHandler = new AlertHandler();
            $upload = new UserUploads($this->db, $alertHandler);
            $upload->videoUpload();
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'upload_video') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('upload_video');
        }
    }

    public function uploadsPending()
    {
        $alertHandler = new AlertHandler();
        $uploadsPending = new UserUploads($this->db, $alertHandler);
        $list = $uploadsPending->uploadsPending();
        return $this->loadView->loadingUser('uploads_pending', $list);
    }

    public function changeAvatar()
    {
        if ($this->request->getMethod() === 'POST') {
            $alertHandler = new AlertHandler();
            $newAvatar = new UserSettings($this->db, $alertHandler);
            $newAvatar->changeAvatar();
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'change_avatar') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('changeavatar');
        }
    }

    public function changePseudo()
    {
        if ($this->request->getMethod() === 'POST') {
            $alertHandler = new AlertHandler();
            $newPseudo = new UserSettings($this->db, $alertHandler);
            $newPseudo->changePseudo();
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'change_pseudo') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('changepseudo');
        }
    }
    public function changePassword()
    {
        if ($this->request->getMethod() === 'POST') {
            $alertHandler = new AlertHandler();
            $newPassword = new UserSettings($this->db, $alertHandler);
            $newPassword->changePassword();
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'change_password') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('changepassword');
        }
    }

    public function newPassword()
    {
        return $this->loadView->loadingUser('newpassword');
    }

    public function proposal()
    {
        if ($this->request->getMethod() === 'POST') {
            $alertHandler = new AlertHandler();
            $newProposal = new UserInteraction($this->db, $alertHandler);
            $newProposal->sendProposal();
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'send_proposal') {
                    if ($alert['type'] == 'success') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->goodAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        } else {
            return $this->loadView->loadingUser('proposal');
        }
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $email =  $this->request->getParsedBody()['email'] ?? '';
            $password =  $this->request->getParsedBody()['password'] ?? '';
            $alertHandler = new AlertHandler();
            $login = new UserAuth($this->db, $alertHandler);
            $login->loginTheUser($email, $password);
            $messages = $alertHandler->getAlerts();
            foreach ($messages as $alert) {
                if ($alert['function'] == 'login') {
                    if ($alert['type'] == 'success') {
                        header('Location:http://lebureaudugame');
                    } elseif ($alert['type'] == 'error') {
                        $alertInfo = $alert['message'];
                        $this->response->getBody()->write(
                            $this->style .
                                $this->badAlert . '<div class="alert-info">' .
                                $this->redirect .
                                $alertInfo . '</br><p style="color:white;font-size:20px;">Redirection...</p></div>'
                        );
                        return $this->response;
                    }
                }
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: http://lebureaudugame');
        die();
    }
}
