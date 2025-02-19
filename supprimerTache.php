<?php
// Inclure la page de connexion à la base de données
include_once "connexion.php";

if (isset($_GET['id'])) {
    // Récupérer l'ID de la tâche à supprimer depuis l'URL
    $tache_id = $_GET['id'];

    // Requête pour supprimer uniquement les champs spécifiés de l'enregistrement
    $requete_supprimer = "UPDATE Cas SET Description = NULL, Progression = NULL, Statut = NULL, Date_debut = NULL, Date_fin = NULL WHERE id = $tache_id";

    if (mysqli_query($con, $requete_supprimer)) {
        // Rediriger l'utilisateur vers la page indexT.php après la suppression
        header("location: indexT.php");
    } else {
        echo "Erreur lors de la suppression des champs de la tâche : " . mysqli_error($con);
    }
} else {
    echo "ID de tâche non spécifié.";
}
?>
