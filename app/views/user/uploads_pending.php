<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/user_contents.css">
</head>

<body>

    <section class="contents_wrapper wrappupp">
        <div class="contents_title">En attente de validation</div>
        <div class="contents_container containupp">
            <?php
            $queryOutput = $loadData[0];
            $row = $loadData[1];
            if ($row > 0) {
                foreach ($queryOutput as $output) {
                    $outputTime = date("H:i", strtotime($output['upload_time']));
                    $ReplaceDate = date("d-m-Y", strtotime($output['upload_date']));
                    $outputDate = str_replace('-', ' ', $ReplaceDate);
                    if (in_array($output['ext'], ['mp4', 'avi', 'webm', 'mkv', 'mov'])) {
                        switch ($output['game_name']) {
                            case "RainbowSixSiege":
                                echo '<div><img src="../../img/games/games_cover/RainbowSixSiege_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "Tarkov":
                                echo '<div><img src="../../img/games/games_cover/Tarkov_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "Apex":
                                echo '<div><img src="../../img/games/games_cover/Apex_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "LostArk":
                                echo '<div><img src="../../img/games/games_cover/LostArk_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "VRising":
                                echo '<div><img src="../../img/games/games_cover/VRising_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "EldenRing":
                                echo '<div><img src="../../img/games/games_cover/EldenRing_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "Furi":
                                echo '<div><img src="../../img/games/games_cover/Furi_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "SkyforceReload":
                                echo '<div><img src="../../img/games/games_cover/SkyforceReload_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "TheRiftbreaker":
                                echo '<div><img src="../../img/games/games_cover/TheRiftbreaker_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                            case "DiabloIV":
                                echo '<div><img src="../../img/games/games_cover/DiabloIV_banner.jpg"><p>' .
                                    $output['category'] . ' de ' . $output['game_name'] . ':</br></br><em>"' . $output['title'] . '"</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                                break;
                        };
                    } else {
                        echo '<div >' .
                            '<img src="' . $output['file_path'] . '"><p>' . ' ' . $output['category'] . ' de ' . $output['game_name'] . '</br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></p></div>';
                    }
                }
            } else {
                echo '<p> Il n\'y a aucun fichier en attente </p>';
            }
            ?>
        </div>
        <div class="divider bottom"></div>
    </section>

    <script type="text/javascript" src="../../../assets/scripts/jquery.min.js"></script>
    <script type="module">
        import {
            userMenu,
            openCloseDropdown
        } from '../../../assets/scripts/main.js';
        userMenu();
        openCloseDropdown();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>