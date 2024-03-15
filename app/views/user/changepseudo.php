<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/user_settings.css">
</head>

<body>

    <section class="settings_wrapper paddWrappPseudo">
        <div class="settings_title">Changer de pseudo</div>
        <div class="settings_container">

            <form action="/postRequest/changePseudo" method="post">

                <label><b>Pseudo actuel</b></label>
                <input type="text" name="currentpseudo" required autocomplete="off">

                <label><b>Nouveau pseudo</b></label>
                <input type="text" name="newpseudo" required autocomplete="off">

                <label><b>Confirmer le nouveau pseudo</b></label>
                <input type="text" name="newpseudo_repeat" required autocomplete="off">

                <button type="submit" class="submitButton">sauvegarder</button>

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
            preventToPressEnter
        } from '../../../assets/scripts/main.js';
        userMenu();
        openCloseDropdown();
        preventSubForm();
        preventToPressEnter();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>