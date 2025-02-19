<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="styleGC.css">
</head>
<body>
    <?php
    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    if(isset($_POST['button'])) {
        // Extraction des informations envoyées dans des variables par la méthode POST
        extract($_POST);

        // Requête de mise à jour
        $update_query = "UPDATE Cas
                         SET numero_proces = '$numero_proces',
                             Front_judiciaire = '$front_judiciaire',
                             client = '$client',
                             Contre = '$Contre',
                             Partie_adverse = '$Partie_adverse',
                             Avocat_de_la_partie = '$avocat_de_la_partie',
                             Date = '$Date',
                             Tribunal = '$tribunal',
                             Note = '$note',
                             Frais_du_dossier = '$frais_du_dossier'
                         WHERE id = $id";

        $result = mysqli_query($con, $update_query);

        if($result) {
            // Si la mise à jour a réussi, redirigez vers la page d'index ou vers une autre page
            header("location: indexGC.php");
        } else {
            $message = "Erreur lors de la modification du dossier";
        }
    }

    // Récupérer l'ID depuis le lien
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Requête pour afficher les informations d'un cas
        $req = mysqli_query($con, "SELECT * FROM Cas WHERE id = $id");
        $row = mysqli_fetch_assoc($req);
    } else {
        $message = "ID du cas non spécifié";
    }
    ?>

    <div class="form">
        <a href="indexGC.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier le cas : <?= $row['numero_proces'] ?> </h2>
        <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label>Numéro du proces</label>
            <input type="text" name="numero_proces" value="<?= $row['numero_proces'] ?>">
            <label>Front judiciaire</label>
            <input type="text" name="front_judiciaire" value="<?= $row['Front_judiciaire'] ?>">
            <label>Client</label>
            <input type="text" name="client" value="<?= $row['client'] ?>">
            <label>Contre</label>
            <input type="text" name="Contre" value="<?= $row['Contre'] ?>">
            <label>Partie adverse</label>
            <input type="text" name="Partie_adverse" value="<?= $row['Partie_adverse'] ?>">
            <label>Avocat de la partie</label>
            <input type="text" name="avocat_de_la_partie" value="<?= $row['Avocat_de_la_partie'] ?>">
            <label>Date</label>
            <input type="date" name="Date" value="<?= $row['Date'] ?>">
            <label>Tribunal</label>
            <input type="text" name="tribunal" value="<?= $row['Tribunal'] ?>">
            <label>Note</label>
            <input type="text" name="note" value="<?= $row['Note'] ?>">
            <label>Frais du dossier</label>
            <input type="text" name="frais_du_dossier" value="<?= $row['Frais_du_dossier'] ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>
