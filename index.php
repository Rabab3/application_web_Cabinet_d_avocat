<?php 
session_start();

if(isset($_POST['boutton-valider'])) {
    // Vérifier si l'utilisateur a entré des informations
    if(isset($_POST['email']) && isset($_POST['mdp'])) {
        // Stocker l'email et le mot de passe dans des variables
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $erreur = "";

        // Connexion à la base de données
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_base_données = "form";

        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);

        // Vérifier si la connexion à la base de données s'est bien déroulée
        if (!$con) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        // Requête pour sélectionner l'utilisateur qui a l'email et le mot de passe entrés
        $req = mysqli_query($con, "SELECT * FROM utilisateur WHERE email = '$email' AND mdp = '$mdp'");

        // Vérifier si la requête SQL s'est bien exécutée
        if (!$req) {
            die("Erreur de requête SQL : " . mysqli_error($con));
        }

        $num_ligne = mysqli_num_rows($req); // Compter le nombre de lignes ayant rapport à la requête SQL

        if($num_ligne > 0) {
            header("Location: bienvenu.php"); // Si le nombre de lignes est > 0, on sera redirigé vers la page bienvenu
            // Nous allons créer une variable de type session qui contiendra l'email de l'utilisateur
            $_SESSION['email'] = $email;
            exit; // Important: arrêter le script après la redirection
        } else {
            $erreur = "Adresse Mail ou Mots de passe incorrects !";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <section>
       <h1>Connexion</h1>
       <?php 
       if(isset($erreur)) {
           // Si la variable $erreur existe, on affiche le contenu ;
           echo "<p class='Erreur'>".$erreur."</p>";
       }
       ?>
       <form action="" method="POST">
           <!-- On ne met plus rien au niveau de l'action pour pouvoir envoyer les données dans la même page -->
          <div class="adr"> <label>Adresse Mail</label></div>
           <input type="text" name="email">     
          <div class="mdp"> <label>Mots de Passe</label></div>
           <input type="password" name="mdp">
           <input type="submit" value="Valider" name="boutton-valider">
       </form>

   </section> 
   <div class="image-container">
       <img src="image.png" alt="Image">
   </div>
</body>
</html>
