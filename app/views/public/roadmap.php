<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Bureau du Game</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/icons/controller.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/no-content-for-now.css">
</head>

<body>

    <section class="noContent_wrapper wrappmap">
        <div class="noContent_title">ROADMAP</div>
        <div class="noContent_container map">

            <p>v0.5.5:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Utilisation de GuzzleHttp pour l'upload et la gestion des vidéos sur le serveur, récupération des thumbnails pour les vidéos
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Comptabiliser tout le contenu pour chaque catégorie de jeux (Affichage dans l'accueil du site)
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Système de recherche de contenu ou personnes
                </li>
            </ul>

            <p>v0.6:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Barre de progression pour suivre l'upload
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Système d'envoi de mails pour les formulaires d'inscription, de mot de passe oublié et contact
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Notification par mail lorsqu'un contenu a été validé ou refusé
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Possibilitée de modifier les préférences pour les notifications
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Espace perso
                </li>
            </ul>

            <p>v0.7:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Intégration de ScrollReveal
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Intégration de PLYR
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Responsive Design
                </li>
            </ul>

            <p>v0.7.5:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    À propos
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    CGU
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Politique de confidentialité
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Lors de l’inscription, case à cocher pour les CGU
                </li>
            </ul>

            <p>v0.8:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Système de progression du compte qui influera sur la taille, le nombre et la fréquence des uploads
                </li>
            </ul>

            <p>v0.9:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Récupération de l'actus des jeux via l'API web Steamworks de Valve
                </li>
            </ul>

            <p>v1.0:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Version mobile (.apk)
                </li>
            </ul>

            <p>v?.??:</p>
            <ul>
                <li>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    Transition SCSS
                </li>
            </ul>
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