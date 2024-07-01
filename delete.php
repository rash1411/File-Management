<?php
session_start();
require_once ('db.php');

// Check if user is logged in as admin
// if (!isset($_SESSION['user_name'])) { // Use 'user_name' if that's what you're storing in the session
//   header('Location: login.php');
//   exit;
// }

// Get the file ID from the query parameter
$id = $_GET['id'];

// Fetch the file details from the database
$stmt = $pdo->prepare('SELECT file_name FROM files WHERE id = ?');
$stmt->execute([$id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if ($file) {
    // Delete the file from the server
    $file_path = 'uploads/' . $file['file_name'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete the file record from the database
    $stmt = $pdo->prepare('DELETE FROM files WHERE id = ?');
    $stmt->execute([$id]);

    // Redirect to the view page or do something else
    header('Location: viewpage.php');
    exit;
} else {
    echo "File not found.";
}
?>