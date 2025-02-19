<?php
// Inclure la page de connexion à la base de données
include_once "connexion.php";

if (isset($_GET['client'])) {
    $client = $_GET['client'];
    $requete = "SELECT * FROM cas WHERE client = '$client'";
    $resultat = mysqli_query($con, $requete);

    if ($resultat) {
        echo "<table>";
        echo "<tr>
                <th>Numéro de dossier</th>
                <th>Date</th>
                <th>Client</th>
                <th>Front judiciaire</th>
                <th>Contre</th>
                <th>Partie adverse</th>
                <th>Avocat de la partie</th>
                <th>Tribunal</th>
                <th>Note</th>
                <th>Frais du dossier</th>
                <th>Actions</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($resultat)) {
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
        echo "</table>";
    } else {
        echo 'error';
    }
} else {
    echo 'missing parameter';
}
?>
