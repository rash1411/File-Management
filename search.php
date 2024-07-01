<?php
session_start();
require_once ('db.php');

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (empty($query)) {
    header('Location: viewpage.php');
    exit;
}

// Search across multiple fields
$stmt = $pdo->prepare('
    SELECT files.id, files.category_id 
    FROM files 
    WHERE subject LIKE ? 
    OR Ref Letter Number LIKE ? 
    OR Ref Letter Date LIKE ? 
    OR Received From LIKE ?
');

$searchTerm = '%' . $query . '%';
$stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if ($file) {
    header('Location: viewFile.php?id=' . $file['id']);
    exit;
} else {
    header('Location: viewPage.php?no_results=true');
    exit;
}
?>