<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la Recherche de Contact</title>
    <link rel="stylesheet" href="styleGC.css">
    <style>
        /* Votre style CSS actuel pour les boutons */
        button {
            padding: 17px 40px;
            border-radius: 50px;
            border: 0;
            background-color: white;
            box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 15px;
            transition: all .5s ease;
        }

        button:hover {
            letter-spacing: 3px;
            background-color: hsl(261deg 80% 48%);
            color: hsl(0, 0%, 100%);
            box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
        }

        button:active {
            letter-spacing: 3px;
            background-color: hsl(261deg 80% 48%);
            color: hsl(0, 0%, 100%);
            box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
            transform: translateY(10px);
            transition: 100ms;
        }
        .table-container {
    margin: 0 auto; /* This will center the table horizontally */
    text-align: center; /* This will center the table content within the container */
}

        
    </style>
</head>
<body>
    <?php
    // Inclure le contenu de bienvenu.php
    include 'bienvenu.php';

    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    // Vérifier si le paramètre 'client' est défini dans l'URL
    if (isset($_GET['client'])) {
        $client = $_GET['client'];

        // Requête pour récupérer les informations du contact correspondant au nom du client
        $requete_contact = "SELECT * FROM Contacts WHERE prenom_nom = '" . mysqli_real_escape_string($con, $client) . "'";
        $resultat_contact = mysqli_query($con, $requete_contact);
        echo "<div class='container'>";

        if (mysqli_num_rows($resultat_contact) > 0) {
            // Afficher un message si le contact correspondant au nom a été trouvé
            echo "<br>";
            echo "<br>";            echo "<br>";
            echo "<br>";

                    echo "<div class='table-container'>";

            echo "<div class='container'>";
            echo "<h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Le contact du '$client'  :</h4>";
            echo "<br>";
            echo "<div class='table-container'>";
            echo "<table>";
            echo "<tr>
                    <th>Numéro de dossier</th>
                    <th>Prénom et nom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Numéro de téléphone</th>
                    <th>Rôles et Relations</th>
                    <th>Note</th>
                    <th>Actions</th>
                  </tr>";

            // Afficher les informations du contact
            while ($row = mysqli_fetch_assoc($resultat_contact)) {
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

            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {        echo "<div class='container'>";

            // Afficher un message si le contact n'a pas été trouvé
            echo "<br>";
            echo "<br>";

            echo "<div class='table-container'>";
            echo "<table>";
            echo "<tr>
                    <th>Numéro de dossier</th>
                    <th>Prénom et nom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Numéro de téléphone</th>
                    <th>Rôles et Relations</th>
                    <th>Note</th>
                    <th>Actions</th>
                  </tr>";

                  echo "</div>";
        }
    }   

    ?><br>
    <button onclick="window.history.back();">Retour</button>
    <div class="espace-vide"></div>           
      <br>
            

</body>
</html>
