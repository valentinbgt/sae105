<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/fonts/varela+round/css.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <title>Hedex</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <?php $page = basename($_SERVER['SCRIPT_FILENAME']);?>
                    <li><a class="nav <?php if($page == "index.php") echo "active"?>" href="./">Accueil</a></li>
                    <li><a class="nav <?php if($page == "donnees.php") echo "active"?>" href="donnees.php">Données</a></li>
                    <li><a class="nav <?php if($page == "contact.php") echo "active"?>" href="contact.php">Contact</a></li>
                    <li><a class="nav <?php if($page == "galerie.php") echo "active"?>" href="galerie.php">Galerie</a></li>
                    <li><a class="nav <?php if($page == "partenaires.php") echo "active"?>" href="partenaires.php">Partenaires</a></li>
                </ul>
            </nav>
        </header>