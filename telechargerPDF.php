<?php
// Inclure la page de connexion
include_once "connexion.php";

if(isset($_GET['id'])){
    $document_id = $_GET['id'];
    
    // Requête pour obtenir le chemin du fichier PDF à partir de la base de données
    $query = mysqli_query($con, "SELECT contenu_fichier FROM Document WHERE id = $document_id");
    $row = mysqli_fetch_assoc($query);

    if($row){
        $contenu_fichier = $row['contenu_fichier'];

        // En-têtes pour forcer le téléchargement du fichier PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="document.pdf"');

        // Lire et afficher le contenu du fichier PDF
        echo $contenu_fichier;
        exit;
    }
}
?>
