<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contacts du Cabinet</title>
    <link rel="stylesheet" href="styleGC.css">
    <style>
        /* Styles pour le pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #c3e5eb;
            padding: 180px; /* Agrandir la taille du pop-up */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .popup-content {
            margin-bottom: 20px;
        }


                    .close-button {
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

            .close-button:hover {
            letter-spacing: 3px;
            background-color: hsl(261deg 80% 48%);
            color: hsl(0, 0%, 100%);
            box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
            }

            .close-button:active {
            letter-spacing: 3px;
            background-color: hsl(261deg 80% 48%);
            color: hsl(0, 0%, 100%);
            box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
            transform: translateY(10px);
            transition: 100ms;
            }
    </style>
</head>
<body>
    <?php
    // Inclure le contenu de bienvenu.php
    include 'bienvenu.php';

    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    // Requête pour récupérer les informations des contacts
    $requete_contacts = "SELECT * FROM teste";
    $resultat_contacts = mysqli_query($con, $requete_contacts);
    ?>

    <div class="container">
        <h2>test </h2>
        <a href="ajouterClient.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <div class="table-container">
        <table>
                <tr>
                    <th>Client</th>
                    <th>Type de Client</th>
                    <th>Statut</th>
                    <th>Note</th>
                    <th>Historique juridique</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($resultat_contacts)) {
                    echo "<tr>";
                    echo "<td>" . $row['client'] . "</td>";
                    echo "<td>" . $row['type_client'] . "</td>"; // Remplacez 'type_client' par le nom de colonne approprié
                    echo "<td>" . $row['statut'] . "</td>"; // Remplacez 'statut' par le nom de colonne approprié
                    echo "<td>" . $row['note'] . "</td>"; // Remplacez 'note' par le nom de colonne approprié

                    echo "<td>
                            <button class='btn-ouvrir' onclick='openPopup(\"" . $row['client'] . "\")'>Historique juridique</button>
                          </td>";
                          echo "<td>
                          <button class='btn-contact' onclick='redirectToIndex(\"" . $row['client'] . "\")'>contact</button>
                       </td>";
                 

                     echo "<td><a href='modifierClient.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
                        <a href='supprimerClient.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Le contenu du pop-up -->
    <div id="popup" class="popup">
        
        <button class="close-button" onclick="closePopup()">Fermer</button>
        <p id="popup-message"></p>
    </div>
    
    <!-- Script JavaScript pour gérer le pop-up -->
    <script>
        function redirectToIndex(client) {
    // Rediriger vers index.php avec le nom du client en tant que paramètre GET
    window.location.href = 'contactSearch.php?client=' + encodeURIComponent(client);
}

function openPopup(client) {
    var popup = document.getElementById('popup');
    var popupMessage = document.getElementById('popup-message');

    // Envoyer la requête AJAX au serveur pour vérifier la correspondance dans la table 'cas'
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'checkCorrespondence.php?client=' + encodeURIComponent(client), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'found') {
                    // Chargez les données correspondantes depuis la table 'cas'
                    loadMatchingCasData(client);
                } else if (response === 'not_found') {
                    popupMessage.textContent = "Aucune correspondance trouvée dans la table 'cas'.";
                    popup.style.display = 'block';
                } else {
                    popupMessage.textContent = "Erreur lors de la recherche.";
                    popup.style.display = 'block';
                }
            } else {
                console.error('Erreur lors de la requête AJAX');
            }
        }
    };
    xhr.send();
}

function loadMatchingCasData(client) {
    var popup = document.getElementById('popup');
    var popupMessage = document.getElementById('popup-message');

    // Envoyer une nouvelle requête AJAX pour récupérer les données correspondantes depuis la table 'cas'
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'loadMatchingCasData.php?client=' + encodeURIComponent(client), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Afficher les données correspondantes dans le pop-up
                popupMessage.innerHTML = xhr.responseText;
                popup.style.display = 'block';
            } else {
                console.error('Erreur lors du chargement des données correspondantes depuis la table cas');
            }
        }
    };
    xhr.send();
}


function loadIndexGCContent() {
    var popup = document.getElementById('popup');
    var popupMessage = document.getElementById('popup-message');

    // Envoyer une nouvelle requête AJAX pour récupérer le contenu de 'indexGC.php'
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'indexGC.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Afficher le contenu de 'indexGC.php' dans le pop-up
                popupMessage.innerHTML = xhr.responseText;
                popup.style.display = 'block';
            } else {
                console.error('Erreur lors du chargement de la page indexGC.php');
            }
        }
    };
    xhr.send();
}

        
        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>
</body>
</html>
