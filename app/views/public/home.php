<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le bureau du game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/home.css">
</head>

<body>

    <section class="banner">
        <div class="banner_container">
            <div class="news">
                <div class="patchnotes">
                    <h1>Suivi de mise à jour</br>
                        <p style="color:darkorange;margin:0">(Temporaire)</p>
                    </h1>

                    <!------------------------------->
                    <!----↓↓ v0.0.5 -> v0.0.50 ↓↓---->
                    <h2>v0.0.0 <i class="fa-solid fa-arrow-right"></i> v0.0.80:</h2>
                    _ HTML ? CSS ? Java..script ? Merise ?!
                    </br>_ Recherche du design général
                    </br>_ Utilisation du framework CSS Bootstrap
                    </br>_ Ajout de Slick puis abandon
                    </br>_ Ajout du plugin Animate On Scroll
                    </br>_ Ajout de la barre de recherche (seulement le css)
                    </br>_ Intégration d'un slider vu sur codepen puis abandon
                    </br>_ Ajout du plugin Swup
                    </br>_ Factorisation du code
                    </br>_ Création de la classe "Carousel"

                    <!------------------>
                    <!----↓↓ v0.1 ↓↓---->
                    </br>
                    <h2> v0.1:</h2>
                    <p>Ajouts:</p>
                    <ul>
                        <li>_ jQuery via le fichier jquery.min.js</li>
                        <li>_ Création de l'interface utilisateur ainsi que les fonctions permettant l'inscription, la connexion,la modification de ses infos de profil
                            </br></hr>(Avatar, Pseudo, Mot de passe) et l'upload de contenu image et vidéo
                        </li>
                        <li>_ Création d'un système de mot de passe oublié</li>
                        <li>_ Mise en place de la base de données</li>
                        <li>_ Page du jeu Kurtzpel</li>
                    </ul>
                    <p>Modifications:</p>
                    <ul>
                        <li>_ Réorganisation de l'arborescence du site</li>
                        <li>_ Nettoyage du code, refactorisation</li>
                        <li>_ Refonte de certains design</li>
                    </ul>
                    <p>Suppressions:</p>
                    <ul>
                        <li>_ Bootstrap</li>
                        <li>_ Animate On Scroll</li>
                        <li>_ Swup</li>
                    </ul>

                    <!------------------>
                    <!----↓↓ v0.2 ↓↓---->
                    </br>
                    <h2> v0.2:</h2>
                    <p>Ajouts:</p>
                    <ul>
                        <li>_ Modals pour la visualisation de screenshots</li>
                        <li>_ Alerte d'erreur pour la connexion et l'inscription</li>
                        <li>_ Page de redirection pour du contenu futur</li>
                        <li>_ Page du jeu Furi</li>
                        <li>_ Lien GitHub</li>
                    </ul>
                    <p>Modifications:</p>
                    <ul>
                        <li>_ Retouche du design de la page des jeux</li>
                        <li>_ Correctif sur tout les systèmes mis en place en v0.1</li>
                    </ul>

                    <!------------------>
                    <!----↓↓ v0.3 ↓↓---->
                    </br>
                    <h2> v0.3:</h2>
                    <p>Ajouts:</p>
                    <ul>
                        <li>_ Création d'un template pour la page des jeux</li>
                        <li>_ Uploads en attente</li>
                        <li>_ Roadmap</li>
                    </ul>
                    <p>Modifications:</p>
                    <ul>
                        <li>_ MAJ du processus d'upload pour les images et vidéos: Design, Fonctionnalitées, indexation en bdd</li>
                        <li>_ Solution de stockage temporaire avec la méthode move_uploaded_files()</li>
                        <li>_ Suppression des deux pages Furi et Kurtzpel</li>
                        </br>
                    </ul>

                    <!------------------>
                    <!----↓↓ v0.4 ↓↓---->
                    </br>
                    <h2> v0.4:</h2>
                    <p>Ajouts:</p>
                    <ul>
                        <li>_ Router Slim</li>
                        <li>_ Espace Admin</li>
                        <li>_ Formulaire de proposition de jeux/catégorie</li>
                        <li>_ Affichage du contenu validé dans leurs pages respectives</li>
                        <li>_ Affichage des screenshots choisis aléatoirement depuis la bdd dans home</li>
                    </ul>
                    <p>Modifications:</p>
                    <ul>
                        <li>_ Organisation des fonctions js via le système de modules</li>
                        <li>_ MAJ pour passer en MVC</li>
                        </br>
                    </ul>

                    <!------------------>
                    <!----↓↓ v0.5 ↓↓---->
                    </br>
                    <h2> v0.5 [En cours]:</h2>
                    <p>Ajouts:</p>
                    <ul>
                        <li>_ Modals d'alertes</li>
                        <li>_ Système de commentaires pour les vidéos</li>
                        <li>_ Système pour mot de passe perdu</li>
                    </ul>
                    <p>Modifications:</p>
                    <ul>
                        <li>_ Template pour la page des jeux</li>
                    </ul>
                    </br>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </section>

    <section class="games_wrapper">
        <section class="games_subwrapper">
            <section class="games_container fadeOutLeft">
                <div class="games_title">FPS</div>
                <div class="games_slider">
                    <div id="carusel1">
                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/R6.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/Tarkov.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/Deadside.png"></a>
                        </div>
                    </div>
                </div>
                <div class="divider bottom"></div>
            </section>
            <section class="category_container fadeOutRight">
                <div class="divider top"></div>
                <div class="category_info">
                    <p>Dernier contributeur: <a href="#">TheNoName</a></p>
                    <p>Meilleur contributeur: <a href="#">TheNoName</a></p>
                    <p>Dernier ajout: <a href="#">Img de NoNamedGame</a></p>
                    <p><a href="#">??</a> Vidéos</p>
                    <p><a href="#">??</a> Screenshots</p>
                </div>
                <div class="divider bottom"></div>
            </section>
        </section>

        <section class="games_subwrapper">
            <section class="games_container fadeOutLeft">
                <div class="games_title">RPG / MMORPG</div>
                <div class="games_slider">

                    <div id="carusel2">
                        <div class="item">
                            <a href="http://lebureaudugame/games/eldenring"><img src="../../../assets/img/games/games_cover/EldenRing.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/PaxDei.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/VRising.webp"></a>
                        </div>
                    </div>
                </div>
                <div class="divider bottom"></div>
            </section>
            <section class="category_container fadeOutRight">
                <div class="divider top"></div>
                <div class="category_info">
                    <p>Dernier contributeur: <a href="#">TheNoName</a></p>
                    <p>Meilleur contributeur: <a href="#">TheNoName</a></p>
                    <p>Dernier ajout: <a href="#">NoNamedGame.mp4</a></p>
                    <p><a href="#">??</a> Vidéos</p>
                    <p><a href="#">??</a> Screenshots</p>
                </div>
                <div class="divider bottom"></div>
            </section>
        </section>

        <section class="games_subwrapper">
            <section class="games_container fadeOutLeft">
                <div class="games_title">Shooter / Hack'N'Slash</div>
                <div class="games_slider">

                    <div id="carusel3">
                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/Furi.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/games/skyforcereloaded"><img src="../../../assets/img/games/games_cover/SkyforceReload.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/Cygni.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="divider bottom"></div>
            </section>
            <section class="category_container fadeOutRight">
                <div class="divider top"></div>
                <div class="category_info">
                    <p>Dernier contributeur: <a href="#">TheNoName</a></p>
                    <p>Meilleur contributeur: <a href="#">TheNoName</a></p>
                    <p>Dernier ajout:</br> <a href="#">NoNamedGame.mp4</a></p>
                    <p><a href="#">??</a> Vidéos</p>
                    <p><a href="#">??</a> Screenshots</p>
                </div>
                <div class="divider bottom"></div>
            </section>
        </section>

        <section class="games_subwrapper">
            <section class="games_container fadeOutLeft">
                <div class="games_title">RTS / Gestion</div>
                <div class="games_slider">

                    <div id="carusel4">
                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/AOEIV.jpg"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/Satisfactory.png"></a>
                        </div>

                        <div class="item">
                            <a href="http://lebureaudugame/nocontent"><img src="../../../assets/img/games/games_cover/NewCycle.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="divider bottom"></div>
            </section>
            <section class="category_container fadeOutRight">
                <div class="divider top"></div>
                <div class="category_info">
                    <p>Dernier contributeur: <a href="#">TheNoName</a></p>
                    <p>Meilleur contributeur: <a href="#">TheNoName</a></p>
                    <p>Dernier ajout:</br> <a href="#">NoNamedGame.mp4</a></p>
                    <p><a href="#">??</a> Vidéos</p>
                    <p><a href="#">??</a> Screenshots</p>
                </div>
                <div class="divider bottom"></div>
            </section>
        </section>
    </section>

    <section class="randomscreenshot_container reveal">
        <div class="randomscreenshot_title">Selection de screenshots</div>
        <div class="randomscreenshot">
            <?php
            $limit = $loadData[0];
            $screenshotListOutput = $loadData[1];
            if (count($screenshotListOutput) > 0) {
                for ($i = 0; $i < min($limit, count($screenshotListOutput)); $i++) {
                    $output = $screenshotListOutput[$i];
                    echo '<img src="' . $output["file_path"] . '" class="img revealImg">';
                }
            } else {
                echo "<p style=\'font-weight:bold;font-size:20px;\'>Aucun screenshots</p>";
            }
            ?>
        </div>
        <div class="divider bottom"></div>
    </section>

    <section class="modal" id="modalBody">
        <img class="modal_content" id="modalImg" />
        <span class="close"><i class="fa-solid fa-xmark"></i></span>
    </section>

    <script type="text/javascript" src="../../../assets/scripts/jquery.min.js"></script>
    <script type="module">
        import {
            loginMenu,
            userMenu,
            openCloseDropdown,
            fadeInOutGamesWrapper,
            slidingCarousel,
            containerFading,
            imgFading,
            openCloseModals
        } from '../../../assets/scripts/main.js';
        loginMenu();
        userMenu();
        openCloseDropdown();
        fadeInOutGamesWrapper();
        slidingCarousel();
        containerFading();
        imgFading();
        openCloseModals();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>