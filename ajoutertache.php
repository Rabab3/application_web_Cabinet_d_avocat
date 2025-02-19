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
    <title>Ajouter une Tâche</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Vérifier si le formulaire a été soumis
        if(isset($_POST['ajouter'])){
            // Extraction des informations envoyées via la méthode POST
            extract($_POST);

            // Connexion à la base de données
            include_once "connexion.php";

            // Requête d'ajout de tâche
            $req = mysqli_query($con, "INSERT INTO Tachess (Tache, Description, Date_debut, Date_fin, Statut) VALUES ('$tache', '$description', '$date_debut', '$date_fin', '$statut')");

            if($req){
                // Si la requête a été effectuée avec succès, effectuer une redirection
                header("location: tache.php");
            } else {
                // Si la requête n'a pas été effectuée avec succès
                $message = "Tâche non ajoutée";
            }
        }
    ?>

    <div class="form">
        <a href="tache.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter une Tâche</h2>
        <p class="erreur_message">
            <?php 
            // Afficher un message d'erreur s'il y en a un
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Tâche</label>
            <input type="text" name="tache" required>

            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>

            <label>Date de début</label>
            <input type="date" name="date_debut" required>

            <label>Date de fin</label>
            <input type="date" name="date_fin" required>

            <label>Statut</label>
            <select name="statut" required>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminé</option>
                <option value="En attente">En attente</option>
            </select>

            <input type="submit" value="Ajouter" name="ajouter">
        </form>
    </div>

    <style>
        /* Styles pour les balises 'select' */
        select {
            width: 48%;
            padding: 10px;
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

        select option {
            font-size: 16px;
        }

        /* Styles pour le bouton "Ajouter" */
        input[type="submit"] {
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        /* Styles pour le textarea */
        textarea {
            width: 48%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px #007BFF;
        }

        /* Style pour créer de l'espace entre les éléments */
        .form label,
        .form input,
        .form textarea,
        .form select {
            margin-bottom: 10px;
        }
    </style>
</body>
</html>
