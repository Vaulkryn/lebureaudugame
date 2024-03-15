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

    <section class="settings_wrapper paddWrappAvatar">
        <div class="settings_title">Changer d'avatar</div>
        <div class="settings_container">

            <p>L’image doit être au format .jpg .jpeg .png .svg ou .gif et ne doit pas dépasser 2 Mo.</p>

            <form action="/postRequest/changeAvatar" method="post" enctype="multipart/form-data" style="width:100%">
                <label class="avatarLabel" for="upload_avatar"><img src="#" id="outputAvatar" /></label>
                <input class="avatarInput" type="file" id="upload_avatar" name="avatar" accept="image/*">
                <button type="submit" class="submitButton">Envoyer</button>
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
            previewAvatar
        } from '../../../assets/scripts/main.js';
        userMenu();
        openCloseDropdown();
        preventSubForm();
        preventToPressEnter();
        previewAvatar();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>