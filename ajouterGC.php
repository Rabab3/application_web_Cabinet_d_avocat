

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
    <?php
        // Vérifier que le bouton "Ajouter" a bien été cliqué
        if(isset($_POST['button'])){
            // Extraction des informations envoyées dans des variables par la méthode POST
            extract($_POST);

            // Connexion à la base de données
            include_once "connexion.php";
            // Requête d'ajout
            $req = mysqli_query($con, "INSERT INTO Cas (numero_proces, Date, client, Front_judiciaire, Contre, Partie_adverse, Avocat_de_la_partie, Tribunal, Note, Frais_du_dossier)
            VALUES ('$numero_dossier', '$date', '$client', '$front_judiciaire', '$contre', '$partie_adverse', '$avocat_de_la_partie', '$tribunal', '$note', '$frais_dossier')");
      if($req){
                // Si la requête a été effectuée avec succès, on fait une redirection
                header("location: indexGC.php");
            } else {
                // Si la requête n'a pas été effectuée avec succès
                $message = "Dossier non ajouté";
            }
        }
    ?>
    <div class="form">
        <a href="indexGC.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un dossier</h2>
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
    <label>Date</label>
    <input type="date" name="date">
    <label>Client</label>
    <input type="text" name="client">
    <label>Front judiciaire</label>
    <input type="text" name="front_judiciaire">
    <label>Contre</label>
    <input type="text" name="contre">
    <label>Partie adverse</label>
    <input type="text" name="partie_adverse">
    <label>Avocat de la partie</label>
    <input type="text" name="avocat_de_la_partie">
    <label>Tribunal</label>
    <input type="text" name="tribunal">
    <label>Note</label>
    <input type="text" name="note">
    <label>Frais du dossier</label>
    <input type="text" name="frais_dossier">
    <input type="submit" value="Ajouter" name="button">
</form>

    </div>
</body>
</html>
