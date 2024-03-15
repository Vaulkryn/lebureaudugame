<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/proposal.css">
</head>

<body>

    <section class="proposal_wrapper">
        <div class="proposal_title">Propositions</div>
        <div class="proposal_container">

            <p>Si vous avez une suggestion de jeu/catégorie, ou si vous avez des remarques pertinentes pour l'amélioration du site, c'est ici !</p>

            <form action="/postRequest/proposal" method="post" enctype="multipart/form-data">
                <textarea name="proposal_text" type="text" class="proposal" placeholder="Vas-y, dis les termes" maxlength="1000"></textarea>
                <button type="submit" class="submitButton">Envoyer</button>
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