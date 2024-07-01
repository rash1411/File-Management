<?php
require_once ('db.php');

$subject = $_POST['subject'];
$letter_number = $_POST['letter_number'];
$letter_date = $_POST['letter_date'];
$received_from = $_POST['received_from'];
$remarks = $_POST['remarks'];
$upload_date = $_POST['upload_date'];
$upload_time = $_POST['upload_time'];
$file_name = $_FILES['file_name']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($file_name);

// Move uploaded file to target directory
if (move_uploaded_file($_FILES['file_name']['tmp_name'], $target_file)) {
    $stmt = $pdo->prepare("INSERT INTO files (subject, letter_number, letter_date, received_from, remarks, file_name, upload_date, upload_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$subject, $letter_number, $letter_date, $received_from, $remarks, $file_name, $upload_date, $upload_time]);
    echo "The file has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>