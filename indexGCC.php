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
    $requete_contacts = "SELECT * FROM Contacts";
    $resultat_contacts = mysqli_query($con, $requete_contacts);
    ?>

    <div class="container">
        <h2>Gestion des Contacts du Cabinet</h2>
        <a href="ajouterGCC.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>Numéro de dossier</th>
                    <th>Prénom et nom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Numéro de téléphone</th>
                    <th>Rôles et Relations</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
                <?php
                
                // Parcourir les résultats de la requête et afficher les informations dans le tableau
                while ($row = mysqli_fetch_assoc($resultat_contacts)) {
                    echo "<tr>";
                    echo "<td>" . $row['numero_dossier'] . "</td>";
                    echo "<td>" . $row['prenom_nom'] . "</td>";
                    echo "<td>" . $row['sexe'] . "</td>";
                    echo "<td>" . $row['date_naissance'] . "</td>";
                    echo "<td>" . $row['adresse'] . "</td>";
                    echo "<td>" . $row['numero_telephone'] . "</td>";
                    echo "<td>" . $row['roles_relations'] . "</td>";
                    echo "<td>" . $row['note'] . "</td>";
                    echo "<td><a href='modifierGCC.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
                              <a href='supprimerGCC.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
