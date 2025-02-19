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
    <title>Ajouter un document</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Inclure la page de connexion
        include_once "connexion.php";

        if(isset($_POST['submit'])) {
            $numero_proces = $_POST['numero_proces'];
            $nom_fichier = $_FILES['pdf_file']['name'];
            $type_fichier = $_FILES['pdf_file']['type'];
            $date_ajout = date('Y-m-d H:i:s');
            
            // Vérifier si un fichier a été envoyé
            if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['pdf_file']['tmp_name'];
                $file_type = $_FILES['pdf_file']['type'];

                // Vérifier que le fichier est bien un PDF
                if($file_type === 'application/pdf') {
                    // Lire le contenu du fichier PDF en tant que données binaires
                    $file_data = file_get_contents($file_tmp);

                    // Échapper les données pour éviter les problèmes d'insertion SQL
                    $escaped_data = mysqli_real_escape_string($con, $file_data);

                    // Requête pour insérer le document dans la base de données
                    $insert_query = "INSERT INTO Document (numero_proces, contenu_fichier, nom_fichier, type_fichier, taille_fichier, date_ajout)
                                     VALUES ('$numero_proces', '$escaped_data', '$nom_fichier', '$type_fichier', " . filesize($file_tmp) . ", '$date_ajout')";
                    $result = mysqli_query($con, $insert_query);

                    if($result) {
                        echo "Document ajouté avec succès dans la base de données.";
                    } else {
                        echo "Erreur lors de l'ajout du document dans la base de données.";
                    }
                } else {
                    echo "Veuillez sélectionner un fichier PDF valide.";
                }
            } else {
                echo "Veuillez sélectionner un fichier PDF.";
            }
        }
    ?>

    <div class="form">
        <a href="indexGD.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un document</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Numéro de procès</label>
            <input type="text" name="numero_proces">
            <label>Nom du fichier</label>
            <input type="text" name="nom_fichier">
            <label>Type du fichier</label>
            <input type="text" name="type_fichier">
            <label>Fichier PDF</label>
            <input type="file" name="pdf_file" accept=".pdf">
            <input type="submit" value="Ajouter" name="submit">
        </form>
    </div>
</body>
</html>
