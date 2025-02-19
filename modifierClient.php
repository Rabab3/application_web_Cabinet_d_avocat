<?php


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

        // Traiter la mise à jour du client si le formulaire est soumis
        if (isset($_POST['modifier'])) {
            // Extraire les nouvelles informations du formulaire
            extract($_POST);

            // Mettre à jour les informations du client dans la base de données
            $update_query = "UPDATE teste SET client = '$client', type_client = '$type_client', statut = '$statut', note = '$note' WHERE id = $client_id";
            $update_result = mysqli_query($con, $update_query);

            if ($update_result) {
                // Rediriger vers la page de liste des clients après la mise à jour
                header("location: test.php");
            } else {
                $message = "Échec de la mise à jour du client.";
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
    <title>Modifier un client</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <div class="form">
        <a href="test.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier un client</h2>
        <p class="erreur_message">
            <?php
            // Afficher un message d'erreur s'il y a lieu
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Client</label>
            <input type="text" name="client" required value="<?php echo $client; ?>">
            
            <label>Type de Client</label>
            <select name="type_client" required>
                <option value="Individuels" <?php if ($type_client === 'Individuels') echo 'selected'; ?>>Individuels</option>
                <option value="Entreprises" <?php if ($type_client === 'Entreprises') echo 'selected'; ?>>Entreprises</option>
                <option value="Organisations" <?php if ($type_client === 'Organisations') echo 'selected'; ?>>Organisations</option>
            </select>
            
            <label>Statut</label>
            <select name="statut" required>
                <option value="Actif" <?php if ($statut === 'Actif') echo 'selected'; ?>>Actif</option>
                <option value="Inactif" <?php if ($statut === 'Inactif') echo 'selected'; ?>>Inactif</option>
            </select>
           
            <label>Note</label>
            <input type="text" name="note" required value="<?php echo $note; ?>">
            
            <input type="submit" value="Modifier" name="modifier">
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
