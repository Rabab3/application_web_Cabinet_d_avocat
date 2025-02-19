<?php
// Inclure la page de connexion à la base de données
include_once "connexion.php";

if (isset($_GET['client'])) {
    $client = $_GET['client'];
    $requete = "SELECT COUNT(*) AS count FROM cas WHERE client = '$client'";
    $resultat = mysqli_query($con, $requete);

    if ($resultat) {
        $row = mysqli_fetch_assoc($resultat);
        if ($row['count'] > 0) {
            echo 'found';
        } else {
            echo 'not_found';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'missing_parameter';
}
?>
