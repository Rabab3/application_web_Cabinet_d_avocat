<?php
// Inclure le contenu de bienvenu.php
include 'bienvenu.php';

// Vérifier si un ID de client a été passé dans l'URL
if (isset($_GET['id'])) {
    $client_id = $_GET['id'];
    
    // Connexion à la base de données
    include_once "connexion.php";

    // Sélectionner les informations du client à partir de la base de données
    $result = mysqli_query($con, "SELECT * FROM teste WHERE id = $client_id");

    if ($row = mysqli_fetch_assoc($result)) {
        // Extraire les informations du client
        $client = $row['client'];
        $type_client = $row['type_client'];
        $statut = $row['statut'];
        $note = $row['note'];

        // Traiter la suppression du client si le formulaire est soumis
        if (isset($_POST['supprimer'])) {
            // Supprimer le client de la base de données
            $delete_query = "DELETE FROM teste WHERE id = $client_id";
            $delete_result = mysqli_query($con, $delete_query);

            if ($delete_result) {
                // Rediriger vers la page de liste des clients après la suppression
                header("location: test.php");
            } else {
                $message = "Échec de la suppression du client.";
            }
        }
    } else {
        // Si aucun client avec cet ID n'est trouvé dans la base de données
        $message = "Client introuvable.";
    }
} else {
    // Si aucun ID de client n'est passé dans l'URL
    $message = "Aucun ID de client spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un client</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <div class="form">
        <a href="test.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Supprimer un client</h2>
        <p class="erreur_message">
            <?php
            // Afficher un message d'erreur s'il y a lieu
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <p>Êtes-vous sûr de vouloir supprimer le client suivant ?</p>
        <p><strong>Client :</strong> <?php echo $client; ?></p>
        <p><strong>Type de Client :</strong> <?php echo $type_client; ?></p>
        <p><strong>Statut :</strong> <?php echo $statut; ?></p>
        <p><strong>Note :</strong> <?php echo $note; ?></p>
        
        <form action="" method="POST">
            <input type="submit" value="Supprimer" name="supprimer">
        </form>
    </div>
</body>
</html>
