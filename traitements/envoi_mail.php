<?php
    if (count($_POST)==0) {
        // Si le le tableau est vide, on affiche le formulaire
        header('location: ../contact.php');
    };
    session_start();

    function displayError($error){
        $_SESSION["information"] = $error;
        header('location: ../contact.php');
        die();
    }

    // Récupération des données du formulaire
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $nom = ucfirst(mb_strtolower($nom));
    $prenom = ucfirst(mb_strtolower($prenom));
    $message=nl2br(htmlspecialchars($_POST['messageContent']));
    $email=$_POST['email'];

    if(!isset($_POST["typeDemande"])) displayError("Spécifiez un type de demande");
    switch ($_POST["typeDemande"]) {
        case 'info':
            $typeDemande = "Votre demande d'information a bien été prise en compte.";
            break;
        
        case 'devis':
            $typeDemande = "Votre demande de devis a été transmise.";
            break;

        case 'reclamation':
            $typeDemande = "Votre réclamation sera traitée dans les meilleurs délais";
            break;
            
        default:
            displayError("Spécifiez un type de demande correct");
            break;
    }
    
    $message1 = "<h2>Confirmation de votre $typeDemande sur SAE105</h2><h3>Bonjour $prenom $nom,</h3>\n<h4>$typeDemande</h4>\n\n<p>Message :</p>\n<p>$message<p>\n\n<p>Merci de nous avoir contacté, nous vous répondrons dans les plus brefs délais.</p>\n<p>Bonne journée.</p>";
    $message1 = "
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$typeDemande</title>
        <style>
            body{
                background-image: url('https://mmi23a02.sae105.ovh/images/background.jpg');
                background-size: cover;
                background-position: center;
                margin: 0;
            }
                main{
                    width: 100%; height: 100%;
                    backdrop-filter: blur(12px) brightness(0.5);
                    color: white;
                    padding: 15px;
                }
        </style>
    </head>
    <body style=\"background-image: url('https://mmi23a02.sae105.ovh/images/background.jpg'); background-size: cover; background-position: center; margin: 0;\">
        <main style='width: 100%; height: 100%; backdrop-filter: blur(12px) brightness(0.5); color: white; padding: 15px;'>
            <h2>Confirmation de votre demande sur SAE105</h2>
            <h3>Bonjour $prenom $nom,</h3>
            <h4>$typeDemande</h4>
            <br>
            <p>Message :</p>
            <p>$message</p>
            <br>
            <p>Merci de nous avoir contacté, nous vous répondrons dans les plus brefs délais.</p>
            <p>Bonne journée.</p>
        </main>
    </body>
</html>
    ";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) displayError("L'adresse mail n'est pas valide");
    if(!isset($nom) || empty($nom)) displayError("Entrez un nom valide.");
    if(!isset($prenom) || empty($prenom)) displayError("Entrez un prénom valide.");
    if(!isset($message) || empty($message)) displayError("Entrez un message valide.");

    //Préparation des variables pour l'envoi du mail de contact
    $subject="SAE 105 : demande de $prenom $nom";
    $headers['From']=$email;                            // Pour pouvoir répondre à la demande de contact
    $headers['Reply-to']=$email;                        // On donne l'adresse de l'utilisateur comme adresse de réponse
    $headers['X-Mailer']='PHP/'.phpversion();
    $headers['MIME-Version'] = '1.0';
    $headers['content-type'] = 'text/html; charset=utf-8';

    // On fixe l'adresse du destinataire
    $email_dest="mmi23a02@mmi-troyes.fr";

    //Envoi du mail avec confirmation d'envoi (ou pas)
    if (mail($email_dest,$subject,$message,$headers)) {
        echo "Mail de contact OK<br>";
    }else {
        displayError("Erreur d'envoi du mail de contact"); 
    }

    // Envoi du mail de confirmation pour le commanditaire

    $email_dest_confirm = $email;
    $subject="Confirmation de votre demande sur SAE105";
    $headers['From']="mmi23a02@mmi-troyes.fr";                            // Pour pouvoir répondre à la demande de contact
    $headers['Reply-to']="no-reply@mmi-troyes.fr";                        // On donne l'adresse de l'utilisateur comme adresse de réponse
    $headers['X-Mailer']='PHP/'.phpversion();
    $headers['MIME-Version'] = '1.0';
    $headers['content-type'] = 'text/html; charset=utf-8';

    //Envoi du mail avec confirmation d'envoi (ou pas)
    if (mail($email_dest_confirm,$subject,$message1,$headers)) {
        echo "Mail de confimation OK<br>";                                 // On confirme l'envoi du message
        $_SESSION["information"] = 'Votre demande a bien été prise en compte';
        header('location: ../');
    }else {
        displayError("Erreur d'envoi du mail de confirmation");                // Le message n'a pas été envoyé - Erreur de traitement
    }
?>