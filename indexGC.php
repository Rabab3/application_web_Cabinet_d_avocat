
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contacts du Cabinet</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    
    <?php
    // Inclure le contenu de bienvenu.php
    include 'bienvenu.php';

    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    // Requête pour récupérer les informations des contacts
    $requete_contacts = "SELECT * FROM Cas";
    $resultat_contacts = mysqli_query($con, $requete_contacts);
    
    ?>

    <div class="container">
        <h2>Gestion des dossiers du Cabinet</h2>
        <a href="ajouterGC.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>Numéro de dossier</th>
                    <th>Date</th>
                    <th>client</th>
                    <th>Front judiciaire</th>
                    <th>Contre</th>
                    <th>Partie adverse</th>
                    <th>Avocat de la partie</th>
                    <th>Tribunale</th>
                    <th>Note</th>
                    <th>Frais du dossier</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Parcourir les résultats de la requête et afficher les informations dans le tableau
                while ($row = mysqli_fetch_assoc($resultat_contacts)) {
                    echo "<tr>";
                    echo "<td>" . $row['numero_proces'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "<td>" . $row['client'] . "</td>";
                    echo "<td>" . $row['Front_judiciaire'] . "</td>";
                    echo "<td>" . $row['Contre'] . "</td>";
                    echo "<td>" . $row['Partie_adverse'] . "</td>";
                    echo "<td>" . $row['Avocat_de_la_partie'] . "</td>";
                    echo "<td>" . $row['Tribunal'] . "</td>";
                    echo "<td>" . $row['Note'] . "</td>";
                    echo "<td>" . $row['Frais_du_dossier'] . "</td>";

                    echo "<td><a href='modifierGC.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
                              <a href='supprimerGC.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    
</body>
</html>
