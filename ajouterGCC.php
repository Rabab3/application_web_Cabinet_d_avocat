
<?php

    // Vérifier que le bouton "Ajouter" a bien été cliqué
    if(isset($_POST['button'])){
        // Extraction des informations envoyées dans des variables par la méthode POST
        extract($_POST);

        // Connexion à la base de données
        include_once "connexion.php";
        // Requête d'ajout
        $req = mysqli_query($con, "INSERT INTO Contacts VALUES (NULL, '$numero_dossier', '$prenom_nom', '$sexe', '$date_naissance', '$adresse', '$numero_telephone', '$roles_relations', '$note')");
        if($req){
            // Si la requête a été effectuée avec succès, on fait une redirection
            header("location: indexGCC.php");
            exit; // Assurez-vous de quitter le script après la redirection
        } else {
            // Si la requête n'a pas été effectuée avec succès
            $message = "Contact non ajouté";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contact</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <div class="form">
        <a href="indexGCC.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un contact</h2>
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
            <input type="text" name="numero_dossier">
            <label>Prénom et nom</label>
            <input type="text" name="prenom_nom">

            <label>Sexe</label>
            <input type="text" name="sexe">

            <label>Statut</label>
            <select name="statut" required>
                <option value="Actif">Actif</option>
                <option value="Inactif">Inactif</option>
            </select>



            <label>Date de naissance</label>
            <input type="date" name="date_naissance">
            <label>Adresse</label>
            <input type="text" name="adresse">
            <label>Numéro de téléphone</label>
            <input type="text" name="numero_telephone">
            <label>Rôles et Relations</label>
            <input type="text" name="roles_relations">
            <label>Note</label>
            <input type="text" name="note">
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
