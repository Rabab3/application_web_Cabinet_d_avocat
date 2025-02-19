<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Vérifier si un ID de tâche est passé dans l'URL
        if(isset($_GET['id'])){
            // Récupérer l'ID de la tâche à partir de l'URL
            $tache_id = $_GET['id'];

            // Connexion à la base de données
            include_once "connexion.php";

            // Requête pour récupérer les informations de la tâche en fonction de son ID
            $requete_tache = "SELECT * FROM Cas WHERE id = $tache_id";
            $resultat_tache = mysqli_query($con, $requete_tache);

            // Vérifier si la tâche existe
            if(mysqli_num_rows($resultat_tache) == 1){
                $tache = mysqli_fetch_assoc($resultat_tache);
            } else {
                // Rediriger vers la page indexTache.php si la tâche n'existe pas
                header("location: indexT.php");
            }
        } else {
            // Rediriger vers la page indexTache.php si l'ID de la tâche n'est pas passé dans l'URL
            header("location: indexT.php");
        }

        // Vérifier si le bouton "Modifier" a été cliqué
        if(isset($_POST['button'])){
            // Extraction des informations envoyées dans des variables par la méthode POST
            extract($_POST);

            // Requête de mise à jour
            $requete_mise_a_jour = "UPDATE Cas SET numero_proces = '$numero_proces', Description = '$Description', Progression = '$Progression', Statut = '$Statut', Date_debut = '$Date_debut', Date_fin = '$Date_fin' WHERE id = $tache_id";
            $resultat_mise_a_jour = mysqli_query($con, $requete_mise_a_jour);
            
            if($resultat_mise_a_jour){
                // Si la mise à jour a été effectuée avec succès, on fait une redirection
                header("location: indexT.php");
            } else {
                // Si la mise à jour n'a pas été effectuée avec succès
                $message = "Mise à jour de la tâche échouée";
            }
        }
    ?>

    <div class="form">
        <a href="indexT.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier une tâche</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Numéro de Dossier</label>
            <input type="text" name="numero_proces" value="<?php echo $tache['numero_proces']; ?>">
            <label>Description</label>
            <input type="text" name="Description" value="<?php echo $tache['Description']; ?>">
            <label>Progression</label>
            <input type="text" name="Progression" value="<?php echo $tache['Progression']; ?>">
            <label>Statut</label>
<!-- Dans votre code HTML -->
<div class="dropdown">
    <div class="dropdown-content">
        <select name="Statut" class="custom-select">
            <option value="En cours" <?php if ($tache['Statut'] == 'En cours') echo 'selected'; ?>>En cours</option>
            <option value="En pause" <?php if ($tache['Statut'] == 'En pause') echo 'selected'; ?>>En pause</option>
            <option value="Terminé" <?php if ($tache['Statut'] == 'Terminé') echo 'selected'; ?>>Terminé</option>
        </select>
    </div>
</div>

            <label>Date de début</label>
            <input type="date" name="Date_debut" value="<?php echo $tache['Date_debut']; ?>">
            <label>Date de fin</label>
            <input type="date" name="Date_fin" value="<?php echo $tache['Date_fin']; ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
<style>
/* Ajoutez ces styles à votre CSS existant */

/* Style pour le bouton personnalisé du menu déroulant */
.custom-select {
    width: 265px; /* Largeur personnalisée */
    height: 40px; /* Hauteur personnalisée */
    padding: 10px; /* Espacement intérieur */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    background-color: #fff;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('images/arrow.png');
    background-position: right center;
    background-repeat: no-repeat;
    margin-bottom: 10px;
}

/* Style pour les options du menu déroulant */
.custom-select option {
    font-size: 16px;
}

</style>
</body>
</html>
