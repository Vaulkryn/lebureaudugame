<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/controlroom.css">
</head>

<body>
    <section class="adminHome_wrapper">
        <section class="media_subwrapper">
            <div class="adminHome_title">Contenu en attente de validation</div>
            <div class="media_container">
                <?php
                $itemOutput = $loadData['itemList'][0];
                $rowItem = $loadData['itemList'][1];
                if ($rowItem > 0) {
                    foreach ($itemOutput as $output) {
                        $outputTime = date("H:i", strtotime($output['upload_time']));
                        $ReplaceDate = date("d-m-Y", strtotime($output['upload_date']));
                        $outputDate = str_replace('-', '/', $ReplaceDate);
                        if (in_array($output['ext'], ['mp4', 'avi', 'webm', 'mkv', 'mov'])) {
                            echo '<div><video controls src="http://lebureaudugame' . $output['file_path'] . '"preload="none" src=""></video><p>' .
                                $output['category'] . ' de ' . $output['pseudo'] . ' du jeu ' . $output['game_name'] . '</br><i>le ' . $outputDate . ' à ' . $outputTime . '</i></p>
                                <form method="post" action="/controlroom" enctype="multipart/form-data"><div class="button_wrapper"><button class="validateButton" name="validatedItem" value="' . $output['ID'] . '" type="submit">Valider</button><button class="cancelButton" name="refusedItem" value="' . $output['ID'] . '" type="submit">Refuser</button></div></form></div>';
                        } else {
                            echo '<div><img src="http://lebureaudugame' . $output['file_path'] . '"><p>' .
                                $output['category'] . ' de ' . $output['pseudo'] . ' du jeu ' . $output['game_name'] . '</br><i>le ' . $outputDate . ' à ' . $outputTime . '</i></p>
                                <form method="post" action="/controlroom" enctype="multipart/form-data"><div class="button_wrapper"><button class="validateButton" name="validatedItem" value="' . $output['ID'] . '" type="submit">Valider</button><button class="cancelButton" name="refusedItem" value="' . $output['ID'] . '" type="submit">Refuser</button></div></form></div>';
                        }
                    }
                } else {
                    echo '<p> Il n\'y a aucun contenu en attente </p>';
                }
                ?>
            </div>
            <div class="divider bottom"></div>
        </section>

        <section class="proposal_subwrapper">
            <div class="adminHome_title">Propositions</div>
            <div class="proposal_container">
                <?php
                $ProposalOutput = $loadData['proposalList'][0];
                $rowProposal = $loadData['proposalList'][1];
                if ($rowProposal > 0) {
                    foreach ($ProposalOutput as $output) {
                        $outputTime = date("H:i", strtotime($output['proposal_time']));
                        $ReplaceDate = date("d-m-Y", strtotime($output['proposal_date']));
                        $outputDate = str_replace('-', '/', $ReplaceDate);
                        echo '<div><p><i>Proposition de ' . $output['pseudo'] . ':</i> ' . $output['proposal_text'] . '</br></br><i>le ' . $outputDate . ' à ' . $outputTime . '</i></p>
                        <form method="post" action="" enctype="multipart/form-data"><div class="button_wrapper"><button class="validateButton" name="acceptedProposal" value="' . $output['ID'] . '" type="submit">Accepter</button><button class="cancelButton" name="refusedProposal" value="' . $output['ID'] . '" type="submit">Refuser</button></div></form></div>';
                    }
                } else {
                    echo '<p> Il n\'y a aucune proposition en attente </p>';
                }
                ?>
            </div>
            <div class="divider bottom"></div>
        </section>

        <section class="logsAdmin_subwrapper">
            <div class="adminHome_title">Logs</div>
            <div class="logsAdmin_container">
                <?php
                $adminLogsOutput = $loadData['adminLogs'];
                foreach ($adminLogsOutput as $output) {
                    $outputTime = date("H:i", strtotime($output['logs_time']));
                    $ReplaceDate = date("d-m-Y", strtotime($output['logs_date']));
                    $outputDate = str_replace('-', '/', $ReplaceDate);
                    if (isset($output['media'])) {
                        $mediaStatus = $output['media_status'];
                        switch ($mediaStatus) {
                            case 'validated':
                                echo '<div><i style="color:lawngreen">Contenu validé:</i></br>' . $output['media'] . ' de ' . $output['pseudo'] . '</br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></div>';
                                break;
                            case 'refused':
                                echo '<div><i style="color:red">Contenu refusé:</i></br>' . $output['media'] . ' de ' . $output['pseudo'] . '</br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></div>';
                                break;
                        }
                    } else {
                        $proposalStatus = $output['proposal_status'];
                        switch ($proposalStatus) {
                            case 'accepted':
                                echo '<div><i style="color:darkorange">Proposition acceptée:</i></br>' . $output['proposal'] . '</br></br><em>Auteur: ' . $output['pseudo'] . '</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></div>';
                                break;
                            case 'refused':
                                echo '<div><i style="color:red">Proposition refusée:</i></br>' . $output['proposal'] . '</br></br><em>Auteur: ' . $output['pseudo'] . '</em></br></br><i>Le ' . $outputDate . ' à ' . $outputTime . '</i></div>';
                                break;
                        }
                    }
                }
                ?>
            </div>
            <div class="divider bottom"></div>
        </section>
    </section>

    <script type="text/javascript" src="../../../assets/scripts/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>