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

    <section class="settings_wrapper">
        <div class="settings_title">s'inscrire</div>
        <div class="settings_container">

            <form action="/postRequest/register" method="post">

                <label for="email"><i class="fa-solid fa-at"></i> Email</label>
                <input type="email" name="email" autocomplete="email" required>

                <label for="pseudo"><i class="fa-solid fa-user"></i> Pseudo</b></label>
                <input type="text" name="pseudo" autocomplete="off" required>

                <label for="password"><i class="fa-solid fa-lock"></i> Mot de passe</label>
                <input type="password" name="password" autocomplete="off" required>

                <label for="password-repeat"><i class="fa-solid fa-lock"></i> Confirmer le mot de passe</label>
                <input type="password" name="password-repeat" autocomplete="off" required>

                <button type="submit" class="submitButton">S'inscrire</button>

            </form>
        </div>
        <div class="divider bottom"></div>
    </section>

    <script type="text/javascript" src="../../../assets/scripts/jquery.min.js"></script>
    <script type="module">
        import {
            loginMenu,
            userMenu,
            openCloseDropdown
        } from '../../../assets/scripts/main.js';
        loginMenu();
        userMenu();
        openCloseDropdown();
    </script>
    <script src="https://kit.fontawesome.com/5122e18abc.js" crossorigin="anonymous"></script>
</body>

</html>