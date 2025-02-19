<?php
// Inclure le contenu de bienvenu.php
include 'bienvenu.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="stylebvn.css">
</head>
<body>
    <?php
       // Vérifier que le bouton "Ajouter" a bien été cliqué
       if(isset($_POST['button'])){
           // Extraction des informations envoyées dans des variables par la méthode POST
           extract($_POST);

           // Connexion à la base de données
           include_once "connexion.php";
           // Requête d'ajout
           $req = mysqli_query($con, "INSERT INTO Taches (nom_tache, description, date_echeance) VALUES ('$nom_tache', '$description', '$date_echeance')");
           if($req){
               // Si la requête a été effectuée avec succès, on fait une redirection
               header("location: indexT.php");
           } else {
               // Si la requête n'a pas été effectuée avec succès
               $message = "Tâche non ajoutée";
           }
       }
    ?>
    <div class="container">
        <a href="indexGT.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter une tâche</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <div class="form">
            <form action="" method="POST">
                <label>Nom de la Tâche</label>
                <input type="text" name="nom_tache">
                <label>Description</label>
                <textarea name="description" rows="5"></textarea>
                <label>Date d'Échéance</label>
                <input type="date" name="date_echeance">
                <input type="submit" value="Ajouter" name="button">
            </form>
        </div>
    </div>
</body>
</html>
