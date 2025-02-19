<?php
// Inclure la page de connexion
include_once "connexion.php";

// Récupérer l'ID du document depuis les paramètres de l'URL
$idDocument = $_GET['id'];

// Requête pour obtenir le contenu du document PDF depuis la base de données
$query = "SELECT contenu_fichier FROM Document WHERE id = $idDocument";
$result = mysqli_query($con, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pdfContent = $row['contenu_fichier'];

        // Définir les en-têtes pour afficher le PDF
        header('Content-type: application/pdf');
        echo $pdfContent;
    } else {
        echo "Document non trouvé.";
    }
} else {
    echo "Erreur de requête : " . mysqli_error($con);
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>
