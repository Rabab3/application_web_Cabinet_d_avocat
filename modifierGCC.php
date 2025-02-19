<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un contact</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Vérifier si un ID de contact est passé dans l'URL
        if(isset($_GET['id'])){
            // Récupérer l'ID du contact à partir de l'URL
            $contact_id = $_GET['id'];

            // Connexion à la base de données
            include_once "connexion.php";

            // Requête pour récupérer les informations du contact en fonction de son ID
            $requete_contact = "SELECT * FROM Contacts WHERE id = $contact_id";
            $resultat_contact = mysqli_query($con, $requete_contact);

            // Vérifier si le contact existe
            if(mysqli_num_rows($resultat_contact) == 1){
                $contact = mysqli_fetch_assoc($resultat_contact);
            } else {
                // Rediriger vers la page indexGCC.php si le contact n'existe pas
                header("location: indexGCC.php");
            }
        } else {
            // Rediriger vers la page indexGCC.php si l'ID du contact n'est pas passé dans l'URL
            header("location: indexGCC.php");
        }

        // Vérifier si le bouton "Modifier" a été cliqué
        if(isset($_POST['button'])){
            // Extraction des informations envoyées dans des variables par la méthode POST
            extract($_POST);

            // Requête de mise à jour
            $requete_mise_a_jour = "UPDATE Contacts SET numero_dossier = '$numero_dossier', prenom_nom = '$prenom_nom', sexe = '$sexe', date_naissance = '$date_naissance', adresse = '$adresse', numero_telephone = '$numero_telephone', roles_relations = '$roles_relations', note = '$note' WHERE id = $contact_id";
            $resultat_mise_a_jour = mysqli_query($con, $requete_mise_a_jour);
            
            if($resultat_mise_a_jour){
                // Si la mise à jour a été effectuée avec succès, on fait une redirection
                header("location: indexGCC.php");
            } else {
                // Si la mise à jour n'a pas été effectuée avec succès
                $message = "Mise à jour du contact échouée";
            }
        }
    ?>

    <div class="form">
        <a href="indexGCC.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier un contact</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Numéro de dossier</label>
            <input type="text" name="numero_dossier" value="<?php echo $contact['numero_dossier']; ?>">
            <label>Prénom et nom</label>
            <input type="text" name="prenom_nom" value="<?php echo $contact['prenom_nom']; ?>">
            <label>Sexe</label>
            <input type="text" name="sexe" value="<?php echo $contact['sexe']; ?>">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" value="<?php echo $contact['date_naissance']; ?>">
            <label>Adresse</label>
            <input type="text" name="adresse" value="<?php echo $contact['adresse']; ?>">
            <label>Numéro de téléphone</label>
            <input type="text" name="numero_telephone" value="<?php echo $contact['numero_telephone']; ?>">
            <label>Rôles et Relations</label>
            <input type="text" name="roles_relations" value="<?php echo $contact['roles_relations']; ?>">
            <label>Note</label>
            <input type="text" name="note" value="<?php echo $contact['note']; ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>
