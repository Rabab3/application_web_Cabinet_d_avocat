

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un contact</title>
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

        // Vérifier si le bouton "Supprimer" a été cliqué
        if(isset($_POST['button'])){
            // Requête de suppression
            $requete_suppression = "DELETE FROM Contacts WHERE id = $contact_id";
            $resultat_suppression = mysqli_query($con, $requete_suppression);

            if($resultat_suppression){
                // Si la suppression a été effectuée avec succès, on fait une redirection
                header("location: indexGCC.php");
            } else {
                // Si la suppression n'a pas été effectuée avec succès
                $message = "Suppression du contact échouée";
            }
        }
    ?>

    <div class="form">
        <a href="indexGCC.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Supprimer un contact</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <p>Voulez-vous vraiment supprimer le contact : <?php echo $contact['prenom_nom']; ?> ?</p>
            <input type="submit" value="Supprimer" name="button">
        </form>
    </div>
</body>
</html>
