<?php
require_once('database.php');

// Récupération du terme de recherche s'il existe
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
  $sql = "SELECT * FROM student2 WHERE nom LIKE :search OR mail LIKE :search ORDER BY id DESC";
  $query = $pdo->prepare($sql);
  $query->execute(['search' => '%' . $search . '%']);
} else {
  $sql = "SELECT * FROM student2 ORDER BY id DESC";
  $query = $pdo->query($sql);
}

$donnees = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Liste des Étudiants - Student2</title>
</head>

<body class="bg-green-100 p-12">
  <div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-green-900 text-center mb-6">Liste des Étudiants (Student2)</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" action="index2.php" class="mb-4 flex flex-col md:flex-row items-center gap-4">
      <div class="flex flex-col md:flex-row items-center gap-4">
        <a href="create2.php" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
          Créer un nouvel étudiant
        </a>
        <a href="index2.php" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
          Actualiser
        </a>
      </div>
      <div class="flex flex-col md:flex-row items-center gap-4">
        <input type="text" name="search" placeholder="Rechercher par nom ou email"
          value="<?= htmlspecialchars($search) ?>" class="px-4 py-2 border rounded-lg w-full md:w-1/3">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
          Rechercher
        </button>
      </div>
    </form>

    <!-- Tableau des étudiants -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow rounded-lg">
        <thead class="bg-green-200">
          <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">ID</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Nom</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Prénom</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Email</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Adresse</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Téléphone</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Date de naissance</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Genre</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Langues</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Niveau d'étude</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Intérêts</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Photo</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Document</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Créé le</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-green-700 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-green-100">
          <?php foreach ($donnees as $donnee): ?>
          <tr class="hover:bg-green-50">
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['id']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['nom']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['prenom']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['mail']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['adresse']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['telephone']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['date_naissance']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['genre']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['langues']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['niveau_etude']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['interets']) ?></td>
            <td class="px-4 py-2 text-sm text-green-900">
              <?php if (!empty($donnee['photo'])): ?>
              <img src="uploads/photos/<?= htmlspecialchars($donnee['photo']) ?>"
                alt="Photo de <?= htmlspecialchars($donnee['nom']) ?>" class="w-16 h-16 object-cover rounded">
              <?php else: ?>
              Aucune
              <?php endif; ?>
            </td>

            <td class="px-4 py-2 text-sm text-green-900">
              <?= $donnee['document'] ? htmlspecialchars($donnee['document']) : 'Aucun' ?>
            </td>
            <td class="px-4 py-2 text-sm text-green-900"><?= htmlspecialchars($donnee['created_at']) ?></td>
            <td class="px-4 py-2 text-sm">
              <a href="update2.php?id=<?= $donnee['id'] ?>"
                class="text-green-600 hover:text-green-900 font-medium mr-2">Modifier</a>
              <a href="delete2.php?id=<?= $donnee['id'] ?>"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');"
                class="text-red-600 hover:text-red-900 font-medium">Supprimer</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>