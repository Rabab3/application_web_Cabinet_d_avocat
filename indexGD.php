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
    <title>Gestion de document</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
        // Inclure la page de connexion
        include_once "connexion.php";
        // Requête pour afficher la liste des documents
        $req = mysqli_query($con, "SELECT * FROM Document");
    ?>
    <div class="container">
        <div class="table-container">
            <table>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <a href="ajouterGD.php" class="Btn_add">Ajouter un document</a>
                    </td>
                </tr>
                <tr id="items">
                    <th>Numéro de procès</th>
                    <th>Nom du fichier</th>
                    <th>Type du fichier</th>
                    <th>Date d'ajout</th>
                    <th>Voir PDF</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    <th>Télécharger</th> <!-- Nouvelle colonne pour le téléchargement -->
                </tr>
                
                <?php 
                if(mysqli_num_rows($req) == 0){
                    // S'il n'existe pas de documents dans la base de données, afficher ce message :
                    echo "<tr><td colspan='7'>Il n'y a pas encore de documents ajoutés !</td></tr>";
                } else {
                    // Sinon, affichons la liste de tous les documents
                    while($row = mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?= $row['numero_proces'] ?></td>
                            <td><?= $row['nom_fichier'] ?></td>
                            <td><?= $row['type_fichier'] ?></td>
                            <td><?= $row['date_ajout'] ?></td>
                            <td><a href="afficherPDF.php?id=<?= $row['id'] ?>" target="_blank">Voir PDF</a></td>
                            <td><a href="modifierGD.php?id=<?= $row['id'] ?>"><img src="images/pen.png"></a></td>
                            <td><a href="supprimerGD.php?id=<?= $row['id'] ?>"><img src="images/trash.png"></a></td>
                            <!-- Lien pour télécharger le PDF -->
                            <td><a href="telechargerPDF.php?id=<?= $row['id'] ?>">Télécharger</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
