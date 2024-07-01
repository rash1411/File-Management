<?php
session_start();

$host = 'localhost';
$db = 'file_management';
$user = 'root'; // Change this to your database user
$pass = ''; // Change this to your database password
// Create a connection
$conn = mysqli_connect($host, $user, $pass);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
// else{
//     echo "Connection was successful";
// }
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}
try {
    // Replace 'hostname', 'database_name', 'username', and 'password' with your actual database details
    $pdo = new PDO('mysql:host=localhost;dbname=file_management', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT files.*, categories.name AS category_name, users.username AS uploaded_by_name 
                           FROM files 
                           INNER JOIN categories ON files.category_id = categories.id 
                           INNER JOIN users ON files.uploaded_by = users.id');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}


$stmt = $pdo->prepare('SELECT files.*, categories.name AS category_name, users.username AS uploaded_by_name FROM files 
                      INNER JOIN categories ON files.category_id = categories.id
                      INNER JOIN users ON files.uploaded_by = users.id');
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Files</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>View Files</h2>
    <table>
        <tr>
            <th>File Name</th>
            <th>Category</th>
            <th>Uploaded By</th>
            <th>Uploaded At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo $file['filename']; ?></td>
                <td><?php echo $file['category_name']; ?></td>
                <td><?php echo $file['uploaded_by_name']; ?></td>
                <td><?php echo $file['uploaded_at']; ?></td>
                <td>
                    <?php if ($_SESSION['is_admin']): ?>
                        <form method="POST" action="delete_file.php">
                            <input type="hidden" name="file_id" value="<?php echo $file['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>