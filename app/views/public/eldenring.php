<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/games.css">
</head>

<body>

    <section class="banner">
        <div class="banner_container">
            <p>/!\ <em>Ici se trouveront les actualités du jeu récupérées grâce à l'API Web Steamworks de Valve</em> /!\</p>
        </div>
        <div class="divider"></div>
    </section>

    <section class="main_wrapper">
        <section class="sticky_wrapper">
            <section class="video_wrapper">
                <div class="divider top"></div>
                <div class="video_container">
                    <video preload="metadata" poster="../../../assets/img/games/games_cover/EldenRing_Cover" allowfullscreen></video>
                </div>
                <div class="divider bottom"></div>

                <?php
                foreach ($loadData as $output) {
                    if ($output['category'] === 'PvP') {
                        $ReplaceDate = date("d-m-Y", strtotime($output['upload_date']));
                        $outputDate = str_replace('-', '/', $ReplaceDate);
                        echo '<div class="video_content" data-id="' . $output['serial_no'] . '">
                        <video controls preload="metadata" src="http://lebureaudugame' . $output['file_path'] . '" allowfullscreen></video>
                        <div class="video_infos">
                            <h4>' . $output['title'] . '</h4>
                            <p>' . $outputDate . '</p>
                        </div>
                        <div class="video_owner">
                            <img src="' . $output['avatar_path'] . '">
                            <a href="">' . $output['pseudo'] . '</a>
                        </div>
                        <div class="video_ownerShortText">
                            <p>' . $output['descript'] . '</p>
                        </div>
                        <div class="game_redirect">
                            <a href="https://www.youtube.com/channel/UCCR6qrG1BV8edeqWE-xnH_Q" target="_blank">
                                <img src="../../../assets/img/games/games_cover/EldenRing_Redirect" alt="">
                                <div class="game_redirectInfos">
                                    <h4>Elden Ring</h4>
                                    <p>2022</p>
                                    <p>Contenus associés à ce jeu <i class="fa-solid fa-angle-right"></i></p>
                                </div>
                            </a>
                        </div>
                        <div class="comments">
                        <h4>Commentaires <i class="fa-solid fa-caret-down"></i></h4>
                        <form method="post" action="" enctype="multipart/form-data" style="width:100%">
                        <textarea name="comment" type="text" placeholder="Ajouter un commentaire" maxlength="1000" required></textarea>
                        <button class="submitButton" type="submit" name="identifier" value="' . $output['serial_no'] . '">Envoyer</button>
                        </form>
                        </div>';
                    }
                }
                ?>
            </section>
        </section>

        <section class="videoList_wrapper" id="videoList">
            <div class="divider top"></div>
            <div class="videoList_container">
                <h4>PvP</h4>
                <div class="videoList_category">
                    <?php
                    if (count($loadData) > 0) {
                        foreach ($loadData as $output) {
                            if ($output['category'] === 'PvP') {
                                echo '<div class="videoList_item">
                                    <img src="../../../assets/img/games/games_cover/EldenRing_List" class="dataImg" data-id="' . $output['serial_no'] . '">
                                    <p>' . $output['title'] . '</p>
                                    </div>';
                            }
                        }
                    } else {
                        echo '<p style="font-size:20px;font-weight:bold;">Aucun contenu</p>';
                    }
                    ?>
                </div>
                <h4>Screenshots</h4>
                <div class="imageList_category">
                    <?php
                    if (count($loadData) > 0) {
                        foreach ($loadData as $output) {
                            if ($output['category'] === 'Screenshot') {
                                echo '<div class="imageList_item">
                                <img class="img" src="' . $output['file_path'] . '">
                                </div>';
                            }
                        }
                    } else {
                        echo '<p style="font-size:20px;font-weight:bold;">Aucun contenu</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="divider bottom"></div>
        </section>
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
            displayVideo,
            openCloseModals
        } from '../../../assets/scripts/main.js';
        loginMenu();
        userMenu();
        openCloseDropdown();
        displayVideo();
        openCloseModals();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>