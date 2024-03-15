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

<body id="imgUpload">

    <section class="contents_wrapper">
        <div class="contents_title">Upload du contenu image</div>
        <div class="contents_container">

            <p>Le contenu sera affiché sur le site après validation.</p>
            <p>L'image doit être au format .jpg .jpeg .png ou .svg et ne pas dépasser 2Mo.</p>
            <p>Pour un upload multiple la taille totale maximum est de 50Mo.</p>

            <form action="/postRequest/uploadImg" method="post" enctype="multipart/form-data" style="width:100%">
                <input type="file" name="img[]" id="uploads" class="inputUpload inputStyle" accept="image/*" data-multiple-caption="{count} fichiers sélectionné" multiple style="display:none"/>
                <label for="uploads"><i class="fa-solid fa-file-arrow-up"></i> <span>Sélectionner</span></label>

                <SELECT name="game_name">
                    <OPTION disabled selected value>Nom du jeu</OPTION>
                    <OPTION value='EldenRing'>Elden Ring</OPTION>
                    <OPTION value='SkyforceReloaded'>Skyforce Reloaded</OPTION>
                </SELECT>

                <output id='output'></output>

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
            previewMultipleImg
        } from '../../../assets/scripts/main.js';
        userMenu();
        openCloseDropdown();
        preventSubForm();
        preventToPressEnter();
        newInputDesign();
        previewMultipleImg();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>