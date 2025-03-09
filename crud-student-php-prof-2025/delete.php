<?php
require_once('database.php');

// $message = "";

if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM etudiants WHERE id = ?";

        $query = $pdo->prepare($sql);

        $query->execute([$id]);

        if ($query->rowCount() > 0) {
          $message = "Etudiant supprimer avec succes";
        } else {
          $message = "Aucun etudiant trouver avec cet ID";
        }
} else {
  $message = "ID invalide ou non spécifié";
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/output.css">
  <title>PHP & SQL delete</title>
</head>

<body>

  <body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h1 class="text-2xl font-bold mb-6 text-red-600">Supprimer un Étudiant</h1>
      <?php if (isset($message)) : ?>
      <p class="mb-4 text-center text-red-500"><?= htmlspecialchars($message); ?></p>
      <?php endif; ?>
      <script type="text/javascript">
      // Redirige vers la page d'accueil après 3 secondes
      setTimeout(function() {
        window.location.replace("index.php");
      }, 3000);
      </script>
    </div>
  </body>


</html>