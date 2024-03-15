<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoadView
{
    private $request;
    private $response;
    private $viewKey;
    private $viewsTable;
    public function __construct(Request $request, Response $response, $viewKey = NULL)
    {
        $this->request = $request;
        $this->response = $response;
        $this->viewKey = $viewKey;
        $this->viewsTable = [
            /**↓↓ /Bricks ↓↓**/
            'header' => 'app/views/bricks/header.php',
            'login' => 'app/views/bricks/login.php',
            'usermenu' => 'app/views/bricks/usermenu.php',
            'footer' => 'app/views/bricks/footer.php',
            /**↓↓ /Public ↓↓**/
            'home' => 'app/views/public/home.php',
            'eldenring' => 'app/views/public/eldenring.php',
            'skyforcereloaded' => 'app/views/public/skyforcereloaded.php',
            'roadmap' => 'app/views/public/roadmap.php',
            'nocontent' => 'app/views/public/no-content-for-now.php',
            /**↓↓ /User ↓↓**/
            'register' => 'app/views/user/register.php',
            'upload_video' => 'app/views/user/upload_video.php',
            'upload_screenshot' => 'app/views/user/upload_screenshot.php',
            'uploads_pending' => 'app/views/user/uploads_pending.php',
            'changeavatar' => 'app/views/user/changeavatar.php',
            'changepseudo' => 'app/views/user/changepseudo.php',
            'changepassword' => 'app/views/user/changepassword.php',
            'newpassword' => 'app/views/user/newpassword.php',
            'proposal' => 'app/views/user/proposal.php',
            /**↓↓ /Admin ↓↓**/
            'controlroom' => 'app/views/admin/ControlRoom.php'
        ];
    }

    private function loadingView($view, $loadData = null)
    {
        $headerPath = $this->viewsTable['header'];
        $loginPath = $this->viewsTable['login'];
        $usermenuPath = $this->viewsTable['usermenu'];
        $footer = $this->viewsTable['footer'];
        ob_start();
        $headerMod = file_get_contents($headerPath);
        $header = $this->bricksModifier('header', $headerMod);
        if (isset($_SESSION['user'])) {
            $usermenuMod = file_get_contents($usermenuPath);
            $userOption = $this->bricksModifier('usermenu', $usermenuMod);
        } else {
            $userOption = file_get_contents($loginPath);
        }
        echo $header;
        echo $userOption;
        require $view;
        require $footer;
        $loadData;
        $content = ob_get_clean();
        $this->response->getBody()->write($content);
        return $this->response;
    }

    public function loadingHome($loadedData)
    {
        if ($this->viewKey !== null) {
            if (array_key_exists($this->viewKey, $this->viewsTable)) {
                $homeview = $this->viewsTable[$this->viewKey];
                if (file_exists($homeview)) {
                    return $this->loadingView($homeview, $loadedData);
                } else {
                    $notFound = new NotFound('Le fichier "home.php" est introuvable');
                    return $notFound($this->request);
                }
            } else {
                $notFound = new NotFound('La clé "' . $this->viewKey . '" n\'existe pas dans le tableau des vues');
                return $notFound($this->request);
            }
        } else {
            $notFound = new NotFound('La fonction "loadingHome" nécessite la clé "home" en dernier paramètre de LoadView');
            return $notFound($this->request);
        }
    }

    public function loadingGames($loadedData)
    {
        if ($this->viewKey !== null) {
            if (array_key_exists($this->viewKey, $this->viewsTable)) {
                $gameView = $this->viewsTable[$this->viewKey];
                if (file_exists($gameView)) {
                    return $this->loadingView($gameView, $loadedData);
                } else {
                    $notFound = new NotFound('Le fichier "' . $this->viewKey . '.php" est introuvable');
                    return $notFound($this->request);
                }
            } else {
                $notFound = new NotFound('La clé "' . $this->viewKey . '" n\'existe pas dans le tableau des vues');
                return $notFound($this->request);
            }
        } else {
            $notFound = new NotFound('La fonction "loadingGames" ne nécessite pas de clé en dernier paramètre de LoadView');
            return $notFound($this->request);
        }
    }

    public function loadingUser($viewKey, $loadedData = null)
    {
        if ($this->viewKey == null) {
            if (array_key_exists($viewKey, $this->viewsTable)) {
                $userview = $this->viewsTable[$viewKey];
                if (file_exists($userview)) {
                    return $this->loadingView($userview, $loadedData);
                } else {
                    $notFound = new NotFound('Le fichier "' . $viewKey . '.php" est introuvable');
                    return $notFound($this->request);
                }
            } else {
                $notFound = new NotFound('La clé "' . $viewKey . '" n\'existe pas dans le tableau des vues');
                return $notFound($this->request);
            }
        } else {
            $notFound = new NotFound('La fonction "loadingUser" ne nécessite pas de clé en dernier paramètre de LoadView');
            return $notFound($this->request);
        }
    }

    public function loadingControlRoom($loadedData)
    {
        if ($this->viewKey !== null) {
            if (array_key_exists($this->viewKey, $this->viewsTable)) {
                $controlView = $this->viewsTable[$this->viewKey];
                if (file_exists($controlView)) {
                    return $this->loadingView($controlView, $loadedData);
                } else {
                    $notFound = new NotFound('Le fichier "' . $this->viewKey . '.php" est introuvable');
                    return $notFound($this->request);
                }
            } else {
                $notFound = new NotFound('La clé "' . $this->viewKey . '" n\'existe pas dans le tableau des vues');
                return $notFound($this->request);
            }
        } else {
            $notFound = new NotFound('La fonction "loadingControlRoom" nécessite la clé "controlroom" en dernier paramètre de LoadView');
            return $notFound($this->request);
        }
    }

    public function loadingTempUse($viewKey)
    {
        if ($this->viewKey == null) {
            if (array_key_exists($viewKey, $this->viewsTable)) {
                $tempView = $this->viewsTable[$viewKey];
                if (file_exists($tempView)) {
                    return $this->loadingView($tempView);
                } else {
                    $notFound = new NotFound('Le fichier "' . $viewKey . '.php" est introuvable');
                    return $notFound($this->request);
                }
            } else {
                $notFound = new NotFound('La clé "' . $viewKey . '" n\'existe pas dans le tableau des vues');
                return $notFound($this->request);
            }
        } else {
            $notFound = new NotFound('La fonction "loadingTempUse" ne nécessite pas de clé en dernier paramètre de LoadView');
            return $notFound($this->request);
        }
    }

    public function bricksModifier($bricksKey, $bricksToMod)
    {
        if ($bricksKey == 'header') {
            $header = $bricksToMod;
            if ($this->viewKey == 'eldenring') {
                $gameName = "Elden Ring";
            } elseif ($this->viewKey == 'skyforcereloaded') {
                $gameName = "Skyforce Reloaded";
            } else {
                $gameName = "";
            }
            if (isset($_SESSION['user']) && isset($_SESSION['avatar'])) {
                $newHeader = str_replace(
                    '<a></a>',
                    '<a>' . htmlspecialchars($gameName) . '</a>',
                    $header
                );
                $newHeader = str_replace(
                    '<a>[S\'inscrire]</a><a>[Connexion]</a>',
                    '<a id="userMenuLink"><img src="http://lebureaudugame' . $_SESSION['avatar'] . '"><i class="arrow arrow_right"></i></a>',
                    $newHeader
                );
                return $newHeader;
            } elseif (isset($_SESSION['user']) && !isset($_SESSION['avatar'])) {
                $newHeader = str_replace(
                    '<a></a>',
                    '<a>' . htmlspecialchars($gameName) . '</a>',
                    $header
                );
                $newHeader = str_replace(
                    '<a>[S\'inscrire]</a><a>[Connexion]</a>',
                    '<a id="userMenuLink"><img src="http://lebureaudugame/assets/img/avatar/avatar_default.jpg"><i class="arrow arrow_right"></i></a>',
                    $newHeader
                );
                return $newHeader;
            } else {
                $newHeader = str_replace(
                    '<a></a>',
                    '<a>' . htmlspecialchars($gameName) . '</a>',
                    $header
                );
                $newHeader = str_replace(
                    '<a>[S\'inscrire]</a><a>[Connexion]</a>',
                    '<a href="http://lebureaudugame/user/s\'inscrire">S\'inscrire</a><a id="loginLink">Connexion</a>',
                    $newHeader
                );
                return $newHeader;
            }
        } elseif ($bricksKey == 'usermenu') {
            $usermenu = $bricksToMod;
            if (isset($_SESSION['user']) && isset($_SESSION['avatar'])) {
                $newUsermenu = str_replace(
                    '<img src="http://lebureaudugame/assets/img/avatar/"><div class="username">[username]</div>',
                    '<img src="http://lebureaudugame' . $_SESSION['avatar'] . '"><div class="username">' . $_SESSION['user'] . '</div>',
                    $usermenu
                );
                return $newUsermenu;
            } elseif (isset($_SESSION['user']) && !isset($_SESSION['avatar'])) {
                $newUsermenu = str_replace(
                    '<img src="http://lebureaudugame/assets/img/avatar/"><div class="username">[username]</div>',
                    '<img src="http://lebureaudugame/assets/img/avatar/avatar_default.jpg"><div class="username">' . $_SESSION['user'] . '</div>',
                    $usermenu
                );
                return $newUsermenu;
            }
        }
    }
}
