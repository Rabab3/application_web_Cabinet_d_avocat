<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients du Cabinet</title>
    <link rel="stylesheet" href="styleGC.css">

</head>
<body>
    <?php
    // Inclure le contenu de bienvenu.php
    include 'bienvenu.php';

    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    // Requête pour récupérer les informations des contacts
    $requete_contacts = "SELECT * FROM clients";
    $resultat_contacts = mysqli_query($con, $requete_contacts);
    ?>

    <div class="container">
        <h2>Gestion des Contacts du Cabinet</h2>
        <a href="ajouterGCC.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <div class="table-container">
            <table>
            <tr>
    <th>Prénom et nom</th>
    <th>Type de Client</th>
    <th>Statut</th>
    <th>Historique juridique</th>
    <th>Contact</th>
    <th>Note</th>
    <th>Actions</th>
</tr>
<?php
// Parcourir les résultats de la requête et afficher les informations dans le tableau
while ($row = mysqli_fetch_assoc($resultat_contacts)) {
    echo "<tr>";
    echo "<td>" . $row['prenom_nom'] . "</td>";
    echo "<td><a href='modifierGCC.php?id=" . $row['id'] . "'><img src='images/pen.png'></a>
              <a href='supprimerGCC.php?id=" . $row['id'] . "'><img src='images/trash.png'></a></td>";
    echo "</tr>";
    echo "<td>
        <button class='btn-historique' data-client='" . $row['prenom_nom'] . "'>Historique juridique</button>
        <button class='btn-contact' data-client='" . $row['prenom_nom'] . "'>Contact</button>
    </td>";
}
?>
            </table>
        </div>
    </div>
<style>/* styleGC.css */

/* Style pour les boutons d'historique et de contact */
.btn-historique,
.btn-contact {
    background-color: #007bff; /* Couleur de fond */
    color: #fff; /* Couleur du texte */
    border: none; /* Supprime la bordure */
    padding: 5px 10px; /* Espacement intérieur */
    cursor: pointer; /* Curseur en forme de main au survol */
    margin-right: 5px; /* Marge à droite pour l'espacement entre les boutons */
}

/* Style pour les boutons au survol */
.btn-historique:hover,
.btn-contact:hover {
    background-color: #0056b3; /* Couleur de fond au survol */
}

/* Style pour les boutons au clic */
.btn-historique:active,
.btn-contact:active {
    background-color: #00418a; /* Couleur de fond au clic */
}
</style>


    <script>
document.addEventListener('DOMContentLoaded', function() {
    const historiqueButtons = document.querySelectorAll('.btn-historique');

    historiqueButtons.forEach(button => {
        button.addEventListener('click', function() {
            const clientName = this.getAttribute('data-client');
            
            fetch(`indexGD.php?client_name=${encodeURIComponent(clientName)}`)
                .then(response => response.json())
                .then(data => {
                    // Crée le contenu du pop-up en fonction des données reçues
                    const popupContent = createPopupContent(data);
                    displayPopup(popupContent);
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des données :', error);
                });
        });
    });

    function createPopupContent(data) {
        let content = '<ul>';
        if (data.length > 0) {
            data.forEach(dossier => {
                content += `<li>${dossier}</li>`;
            });
        } else {
            content += '<li>Aucun dossier juridique pour ce client.</li>';
        }
        content += '</ul>';
        return content;
    }

    function displayPopup(content) {
        // Affiche le pop-up avec le contenu spécifié (vous pouvez utiliser une bibliothèque ou créer votre propre)
        // Par exemple, en utilisant un pop-up Bootstrap Modal :
        $('#myModal .modal-body').html(content);
        $('#myModal').modal('show');
    }
});
</script>


</body>
</html>
