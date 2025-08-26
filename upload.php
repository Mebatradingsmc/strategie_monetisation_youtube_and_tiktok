<?php

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Récupère le fichier téléchargé
  $fichier = $_FILES["fichier"];

  // Vérifie si le fichier est valide
  if ($fichier["error"] !== UPLOAD_ERR_OK) {
    echo "Erreur lors du téléchargement du fichier : " . $fichier["error"];
    exit;
  }

  // Déplace le fichier vers le serveur
  move_uploaded_file($fichier["tmp_name"], "uploads/" . $fichier["name"]);

  // Vérifie si la tâche est terminée
  if ($fichier["name"] == "tache_terminee.txt") {

    // Ajoute la requête de la succession
    $requete = "INSERT INTO succession (nom, date) VALUES ('Nom de la succession', NOW())";
    $resultat = mysqli_query($bdd, $requete);

    if ($resultat) {
      echo "La requête de la succession a été ajoutée avec succès.";
    } else {
      echo "Erreur lors de l'ajout de la requête de la succession : " . mysqli_error($bdd);
    }
  }
}

?>
