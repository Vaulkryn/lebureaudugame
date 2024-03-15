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

    <section class="contents_wrapper wrappvideo">
        <div class="contents_title">Upload une video</div>
        <div class="contents_container">

            <p>Le contenu sera affiché sur le site après validation.</p>
            <p>La vidéo doit être au format .mp4, .avi, .webm, .mkv, .mov et ne pas dépasser 500Mo.</p>

            <form action="/postRequest/uploadVideo" method="post" enctype="multipart/form-data" style="width:100%">
                <input type="file" name="video" id="uploads" class="inputUpload inputStyle" accept="video/*" multiple style="display:none" />
                <label for="uploads"><i class="fa-solid fa-file-arrow-up"></i> <span>Sélectionner</span></label>

                <SELECT name="game_name">
                    <OPTION disabled selected value> Nom du jeu </OPTION>
                    <OPTION value='EldenRing'>Elden Ring</OPTION>
                    <OPTION value='SkyforceReloaded'>Skyforce Reloaded</OPTION>
                </SELECT>

                <SELECT name="video_category">
                    <OPTION disabled selected value> Catégorie </OPTION>
                </SELECT>

                <input name="title" type="text" placeholder="Titre" class="textInput" maxlength="40" />
                <textarea name="description" type="text" placeholder="Description" maxlength="740"></textarea>

                <div class="button_wrapper">
                    <button class="cancelButton" type="button" onclick="window.location.reload(true);">Annuler la selection</button>
                    <button class="submitButton" type="submit">Envoyer</button>
                </div>
            </form>

        </div>
        <div class="divider bottom"></div>
    </section>

    <script type="text/javascript" src="../../../assets/scripts/jquery.min.js"></script>
    <script type="module">
        import {
            userMenu,
            openCloseDropdown,
            preventSubForm,
            preventToPressEnter,
            newInputDesign,
            updateOptions
        } from '../../../assets/scripts/main.js';
        userMenu();
        openCloseDropdown();
        preventSubForm();
        preventToPressEnter();
        newInputDesign();
        updateOptions();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>