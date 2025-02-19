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
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="styleGC.css">
   
</head>
<body>
    <?php
        // Vérifier que le formulaire a été soumis
        if(isset($_POST['ajouter'])){
            // Extraction des informations envoyées dans des variables par la méthode POST
            extract($_POST);

            // Connexion à la base de données
            include_once "connexion.php";

            // Requête d'ajout
            $req = mysqli_query($con, "INSERT INTO teste (client, type_client, statut, note) VALUES ('$client', '$type_client', '$statut', '$note')");

            if($req){
                // Si la requête a été effectuée avec succès, on fait une redirection
                header("location: test.php");
            } else {
                // Si la requête n'a pas été effectuée avec succès
                $message = "Client non ajouté";
            }
        }
    ?>

    <div class="form">
        <a href="test.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un client</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Client</label>
            <input type="text" name="client" required>
            
            <label>Type de Client</label>
            <select name="type_client" required>
                <option value="Individuels">Individuels</option>
                <option value="Entreprises">Entreprises</option>
                <option value="Organisations">Organisations</option>
            </select>
            
            <label>Statut</label>
            <select name="statut" required>
                <option value="Actif">Actif</option>
                <option value="Inactif">Inactif</option>
            </select>
           
            <label>Note</label>
            <input type="text" name="note" required>
            
            <input type="submit" value="Ajouter" name="ajouter">
        </form>
    </div>
    <style>
        /* Style pour les balises 'select' */
        select {
            width: 48%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            appearance: none; /* Supprime la flèche du menu déroulant sous Chrome et Safari */
            -webkit-appearance: none; /* Pour Safari */
            -moz-appearance: none; /* Pour Firefox */
            background-image: url('images/arrow.png'); /* Ajoutez une icône personnalisée si nécessaire */
            background-position: right center;
            background-repeat: no-repeat;
            margin-bottom: 10px; /* Ajout de marge en bas pour créer de l'espace */
        }

        /* Style pour les options du menu déroulant */
        select option {
            font-size: 16px;
        }

        /* Style pour le bouton "Ajouter" */
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Style pour créer de l'espace entre les éléments */
        .form label,
        .form input,
        .form select {
            margin-bottom: 10px; /* Ajout de marge en bas pour créer de l'espace */
        }
    </style>
</body>
</html>
