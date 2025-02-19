<?php 
// On démarre la session sur cette page 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="stylebvn.css">

    <!-- Add the CSS for the sidebar menu -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <!-- The sidebar menu code -->
    <nav >
      <div class="logo" >
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">AvocEase</span>
      </div>
      <div class="search-bar">
  <input type="text" id="searchInput" placeholder="Rechercher...">
  <button id="searchButton">Rechercher</button>
</div>
<p id="searchMessage" style="display: none; color: red;">Aucun résultat trouvé.</p>


      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">AvocEase</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="bienvenu.php" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Accueil</span>
              </a>
            </li>
            <li class="list">
              <a href="indexGC.php" class="nav-link">
                <i class="bx bx-bar-chart-alt-2 icon"></i>
                <box-icon name='briefcase'></box-icon>
                <span class="link">Gestion de dossier</span>
              </a>
            </li>
            <li class="list">
              <a href="indexT.php" class="nav-link">
                <i class="bx bx-bell icon"></i>
                <span class="link">Gestion des tâches</span>
              </a>
            </li>
            <li class="list">
              <a href="indexGCC.php" class="nav-link">
                <i class="bx bx-message-rounded icon"></i>
                <span class="link">Gestion des contacts</span>
              </a>
            </li>
            <li class="list">
              <a href="indexGD.php" class="nav-link">
                <i class="bx bx-file icon"></i>
                <span class="link">Gestion de Docum..</span>
              </a>
            </li>
            <li class="list">
              <a href="test.php" class="nav-link">
                <i class="bx bx-user icon"></i>
                <span class="link">Gestion des Clients</span>
              </a>
            </li>

   <label class="switch">

</label><br><br><br><br>
</label>
              <li class="list">
               <a href="logout.php" class="nav-link">
               <i class="bx bx-log-out icon"></i>
               <span class="link">Logout</span>
               </a>
               </li>
 
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <script>
      // The JavaScript code for the sidebar menu
      const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

      menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
          navBar.classList.toggle("open");
        });
      });

      overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
      });
    </script>

    


<style>/* Styles pour le champ de recherche */
.search-bar {
  display: flex;
  align-items: center;
  margin-right: 20px; /* Ajustez la marge selon vos besoins */
}

#searchInput {
  padding: 8px;
  border: none;
  border-radius: 5px;
  outline: none;
}

#searchButton {
  background-color: #42db75;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  padding: 8px 16px;
  cursor: pointer;
}

#searchButton:hover {
  background-color: #3aaa62; /* Changez la couleur au survol si nécessaire */
}
</style>
<script>
document.getElementById("searchButton").addEventListener("click", function () {
  const searchInput = document.getElementById("searchInput");
  const searchTerm = searchInput.value.trim(); // Obtenez le terme de recherche sans les espaces vides
  const contentToSearch = document.body.innerHTML;

  if (searchTerm !== "") {
    const regex = new RegExp(searchTerm, "gi");
    const highlightedContent = contentToSearch.replace(
      regex,
      (match) => `<span style="background-color: #42db75">${match}</span>`
    );

    document.body.innerHTML = highlightedContent;
    
    const searchMessage = document.getElementById("searchMessage");
    
    // Vérifiez si des correspondances ont été trouvées
    if (highlightedContent.includes('<span style="background-color: #42db75">')) {
      searchMessage.style.display = "none"; // Masquez le message
    } else {
      searchMessage.style.display = "block"; // Affichez le message
    }
  }
});

</script>
</body>
</html>
