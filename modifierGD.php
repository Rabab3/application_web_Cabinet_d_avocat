

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un document</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Inclure la page de connexion
        include_once "connexion.php";

        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            $numero_proces = $_POST['numero_proces'];
            $nom_fichier = $_POST['nom_fichier'];
            $type_fichier = $_POST['type_fichier'];
            
            // Vérifier si un fichier a été envoyé
            if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['pdf_file']['tmp_name'];
                $file_name = $_FILES['pdf_file']['name'];
                $file_type = $_FILES['pdf_file']['type'];

                // Vérifier que le fichier est bien un PDF
                if($file_type === 'application/pdf') {
                    // Lire le contenu du fichier PDF en tant que données binaires
                    $file_data = file_get_contents($file_tmp);

                    // Échapper les données pour éviter les problèmes d'insertion SQL
                    $escaped_data = mysqli_real_escape_string($con, $file_data);

                    // Requête pour mettre à jour le document dans la base de données
                    $update_query = "UPDATE Document 
                                     SET numero_proces = '$numero_proces', 
                                         contenu_fichier = '$escaped_data', 
                                         nom_fichier = '$file_name', 
                                         type_fichier = '$file_type', 
                                         taille_fichier = " . filesize($file_tmp) . " 
                                     WHERE id = $id";
                    $result = mysqli_query($con, $update_query);

                    if($result) {
                        echo "Document modifié avec succès dans la base de données.";
                    } else {
                        echo "Erreur lors de la modification du document dans la base de données.";
                    }
                } else {
                    echo "Veuillez sélectionner un fichier PDF valide.";
                }
            } else {
                // Requête pour mettre à jour les autres informations sans changer le fichier
                $update_query = "UPDATE Document 
                                 SET numero_proces = '$numero_proces', 
                                     nom_fichier = '$nom_fichier', 
                                     type_fichier = '$type_fichier'
                                 WHERE id = $id";
                $result = mysqli_query($con, $update_query);

                if($result) {
                    echo "Document modifié avec succès dans la base de données.";
                } else {
                    echo "Erreur lors de la modification du document dans la base de données.";
                }
            }
        }

        // Récupérer l'ID du document depuis le lien
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Requête pour afficher les infos d'un document
            $req = mysqli_query($con, "SELECT * FROM Document WHERE id = $id");
            $row = mysqli_fetch_assoc($req);
        } else {
            echo "ID du document non spécifié.";
        }
    ?>

    <div class="form">
        <a href="indexGD.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier le document : <?= $row['numero_proces'] ?></h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label>Numéro de procès</label>
            <input type="text" name="numero_proces" value="<?= $row['numero_proces'] ?>">
            <label>Fichier PDF</label>
            <input type="file" name="pdf_file" accept=".pdf">
            <label>Nom du fichier</label>
            <input type="text" name="nom_fichier" value="<?= $row['nom_fichier'] ?>">
            <label>Type du fichier</label>
            <input type="text" name="type_fichier" value="<?= $row['type_fichier'] ?>">
            <label>Date d'ajout</label>
            <input type="text" name="date_ajout" value="<?= $row['date_ajout'] ?>" disabled>
            <input type="submit" value="Modifier" name="submit">
        </form>
    </div>
</body>
</html>
