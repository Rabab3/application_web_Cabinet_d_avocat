<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <link rel="stylesheet" href="styleGC.css">
    <style>
        /* Style CSS pour centrer le contenu horizontalement */
        .center-table {
            margin: 150px auto 0; /* Marge automatique sur les côtés gauche et droit, 30px en haut */
            width: 80%; /* Largeur souhaitée de la table */
             

        /* Style CSS pour le bouton d'ajout en vert */
        .btn-vert {
    background-color: #34c969; /* Couleur de fond verte */
    color: white; /* Couleur du texte en blanc */
    padding: 7px 16px; /* Espacement intérieur du bouton */
    text-decoration: none; /* Suppression du soulignement du lien */
    border: none; /* Suppression de la bordure */
    border-radius: 5px; /* Coins arrondis */
    cursor: pointer; /* Curseur de type pointeur au survol */
    text-align: center; /* Centre le texte horizontalement */
    line-height: 36px; /* Ajuste la hauteur de ligne pour centrer verticalement */
}

.btn-vert img {
    vertical-align: middle; /* Centre l'image verticalement */
    margin-right: 3px; /* Marge à droite de l'image pour l'espacement */
}


        }
    </style>
</head>
<body>
    <?php
    // Inclure la page de connexion à la base de données
    include_once "connexion.php";
    include 'bienvenu.php';

    // Requête pour récupérer les données des tâches
    $requete_taches = "SELECT * FROM Cas";
    $resultat_taches = mysqli_query($con, $requete_taches);
    ?>
  
    
    <!-- Ajout de la classe CSS pour centrer la table -->
    <table class="center-table">
        <tr>
            <th>Numéro de Dossier</th>
            <th>Description</th>
            <th>Progression</th>
            <th>Statut</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>List des taches</th>
            <th>Actions</th>
        </tr>
        <?php
        // Parcourir les résultats de la requête et afficher les données des tâches dans le tableau
        while ($row = mysqli_fetch_assoc($resultat_taches)) {
            echo "<tr>";
            echo "<td>" . $row['numero_proces'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['Progression'] . "</td>";
            echo "<td>" . $row['Statut'] . "</td>";
            echo "<td>" . $row['Date_debut'] . "</td>";
            echo "<td>" . $row['Date_fin'] . "</td>";
            echo "<td><a href='tache.php?id=" . $row['id'] . "' class='btn-vert'><img src='images/plus.png'></a> </td>";
            echo "<td><a href='modifierGC.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
                  <a href='supprimerGC.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
