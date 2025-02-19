

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un document</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Vérifier si l'ID du document à supprimer est passé en paramètre
        if(isset($_GET['id'])) {
            // Récupérer l'ID du document depuis le paramètre de l'URL
            $id = $_GET['id'];

            // Inclure la page de connexion
            include_once "connexion.php";

            // Requête de suppression du document en fonction de son ID
            $req = mysqli_query($con, "DELETE FROM Document WHERE id = $id");
            if($req) {
                // Si la requête a été effectuée avec succès, on fait une redirection vers la page indexGD.php
                header("location: indexGD.php");
            } else {
                // Si la requête de suppression a échoué
                $message = "Erreur lors de la suppression du document";
            }
        } else {
            // Si l'ID du document n'a pas été spécifié dans l'URL, afficher un message d'erreur
            $message = "ID du document non spécifié";
        }
    ?>

    <div class="container">
        <h2>Supprimer un document</h2>
        <p class="erreur_message">
            <?php 
            // Si la variable "message" existe, affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <a href="indexGD.php" class="back_btn"><img src="images/back.png"> Retour</a>
    </div>
</body>
</html>
