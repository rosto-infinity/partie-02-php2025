<?php
require_once('database.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
  exit('ID manquant.');
}

$id = $_GET['id'];

$sql = "DELETE FROM student2 WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Redirection vers la page d'affichage3
header("Location: index2.php");
exit;