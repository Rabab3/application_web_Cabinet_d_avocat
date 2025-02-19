<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
    // Inclure la page de connexion à la base de données
    include_once "connexion.php";
    include 'bienvenu.php';

    // Requête pour récupérer les données des tâches
    $requete_taches = "SELECT * FROM Tachess";
    $resultat_taches = mysqli_query($con, $requete_taches);
    ?>

    <div class="container">
    <br><br><br>
        <a href="ajoutertache.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <style>
            /* Style CSS pour le bouton "Retour" */
.Btn_retour {
    display: inline-block;
    padding: 10px 20px;
    background-color:  #3aaa50;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 10px;
}

.Btn_retour:hover {
    background-color:  #3aaa80;
}

        </style>
        <!-- Bouton de retour vers indexT.php -->
        <a href="indexT.php" class="Btn_retour">Retour</a>

        <div class="table-container">
            <table>
                <tr>
                    <th>Tâche</th>
                    <th>Description</th>
                    <th>Date de début</th> <!-- Ajout de la colonne "Date de début" -->
                    <th>Date de fin</th> <!-- Ajout de la colonne "Date de fin" -->
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Parcourir les résultats de la requête et afficher les données des tâches dans le tableau
                while ($row = mysqli_fetch_assoc($resultat_taches)) {
                    echo "<tr>";
                    echo "<td>" . $row['Tache'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "<td>" . $row['Date_debut'] . "</td>"; // Afficher la date de début
                    echo "<td>" . $row['Date_fin'] . "</td>"; // Afficher la date de fin
                    echo "<td>" . $row['Statut'] . "</td>";
                    echo "<td><a href='modifierTache.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
                              <a href='supprimerTache.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
                    echo "</tr>";
/*
// Vérifier si la date de début est dans les 3 jours à venir pour envoyer un SMS
$dateDebut = strtotime($row['Date_debut']);
$troisJoursAVenir = strtotime("+3 days");
if ($dateDebut <= $troisJoursAVenir) {
    // Inclure le fichier sendSMS.php pour envoyer le SMS
    include 'sendSMS.php';

    // Envoyer le SMS à l'avocat
    $avocatNumero = 'YOUR_AVOCAT_PHONE_NUMBER'; // Remplacez par le numéro de téléphone de l'avocat
    $message = "Rappel : La tâche '" . $row['Tache'] . "' commence dans 3 jours.";
    envoyerSMS($avocatNumero, $message);
}*/

                    
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
