<?php
    session_start();
    // Vérification de sélection d'un fichier
    // Récupération des attributs du fichier (nom,type,taille)
    if (!empty($_FILES)) {
        $image_nom=$_FILES['image']['name'];
        $image_type=$_FILES['image']['type'];
        $image_taille=$_FILES['image']['size'];
        $image_temporaire=$_FILES['image']['tmp_name'];
        $image_error=$_FILES['image']['error'];
    } else {
        echo 'Vous devez sélectionner un fichier';
    }

    // Vérification temporaire - A supprimer à la fin de l'exercice
    /* echo 'Nom de l\'image : '.$image_nom.'<br>';
    echo 'Type de fichier : '.$image_type.'<br>';
    echo 'Taille du fichier : '.$image_taille.'<br>';
    echo 'Nom temporaire : '.$image_temporaire.'<br>';
    echo 'Code erreur : '.$image_error.'<br>'; */

    // Début Vérification de la conformité
    $affichage_erreurs='';
    $erreurs=0;

    // Test si pas d'erreur de sélection
    if ($image_error == 0) {
        // Test format du fichier en fonction de l'extension
            if ($image_type != 'image/jpeg') {
            $affichage_erreurs ='Le fichier n\'est pas au format jpeg ou extension invalide';
            $erreurs++;
        }

        // Test format du fichier avec la fonction exif_imagetype
        if (exif_imagetype($image_temporaire) != IMAGETYPE_JPEG) {
            $affichage_erreurs ='Ce fichier n\'est pas une image jpeg';
            $erreurs++;
        }

    } else {
        $affichage_erreurs='Impossible de télécharger le fichier, erreur de sélection';
    }

    // On affiche les erreurs
    if ($erreurs != 0) {
        $affichage_erreurs;
    } else {
        echo 'Fichier conforme<br>';
    }

    if($image_taille > 500000) $affichage_erreurs = "La taille du fichier sélectionné est supérieure à 500Ko :/";

    if ($erreurs == 0) {									// Si fichier conforme
        // On récupére le nombre de fichiers dans images/galerie
        $nbFichiers=-2;                         				// Le dossier contient deux fichier cachés . et ..
        $dossier= opendir("../images/galerie");
        while ($fichier = readdir($dossier)) {
            $nbFichiers++;
        }

        // On renomme le fichier - imageN.jpg
        $image_num=$nbFichiers+1;
        $image_nom='image'.$image_num.'.jpg';

        // On fixe le nom complet de la destination (chemin relatif/imageN.jpg)
        $destination="../images/galerie/".$image_nom;

        // On déplace le fichier dans son emplacement définitif
        if (move_uploaded_file($image_temporaire, $destination)) {
            $erreurs=0;
        } else {
            $affichage_erreurs='Erreur de téléchargement';
            $erreurs++;
        }
    }

    // On affiche les erreurs
    if ($erreurs != 0) {
        $_SESSION["information"] = $affichage_erreurs;
        header('location: ../galerie.php');
    } else {
        $_SESSION["information"] = 'Téléchargement terminé avec succès';
        header('location: ../galerie.php');
    }
?>