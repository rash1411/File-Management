<?php
session_start();
require_once ('db.php');

// Fetch category ID from the URL
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';

// Fetch category name
$category_name_stmt = $pdo->prepare('SELECT name FROM categories WHERE id = ?');
$category_name_stmt->execute([$category_id]);
$category_name = $category_name_stmt->fetch(PDO::FETCH_ASSOC)['name'];

// Prepare the SQL query with search and sort options
$query = 'SELECT * FROM files WHERE category_id = ?';
$params = [$category_id];

if (!empty($search_query)) {
    $query .= ' AND (subject LIKE ? OR letter_number LIKE ? OR received_from LIKE ? OR remarks LIKE ?)';
    $search_term = '%' . $search_query . '%';
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

$query .= ' ORDER BY upload_date ' . ($sort_order === 'DESC' ? 'DESC' : 'ASC');

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check user role
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($category_name); ?> Files</title>
    <link rel="stylesheet" href="style.css" /> <!-- Ensure your external stylesheet is linked -->
    <style>
        /* Additional styles can go here if needed */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .header {
            background-color: brown;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            height: 50px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons a {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 8px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-buttons a.btn-primary {
            background-color: #007bff;
        }

        .action-buttons a.btn-primary:hover {
            background-color: #0056b3;
        }

        .action-buttons a.btn-info {
            background-color: #17a2b8;
        }

        .action-buttons a.btn-info:hover {
            background-color: #117a8b;
        }

        footer {
            background-color: brown;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .logout ul {
            display: flex;
            justify-content: flex-end;
            list-style-type: none;
            padding: 0;
        }

        .logout ul li {
            margin-left: 20px;
        }

        .logout ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .logout ul li a:hover {
            opacity: 1;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-header .close {
            font-size: 24px;
            cursor: pointer;
        }

        .modal-body table {
            width: 100%;
            border-collapse: collapse;
        }

        .modal-body th,
        .modal-body td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .modal-footer {
            text-align: right;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }



        .sort-search-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .sort-dropdown {
            margin-left: 10px;
        }

        .sort-dropdown select {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-bar {
            flex: 1;
            margin-left: 10px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="drdo-logo.png" alt="DRDO Logo">
        <h1>Centre for Fire, Explosive and Environment Safety (CFEES)<br>
            अग्नि, विस्फोटक और पर्यावरण सुरक्षा केंद्र (सीएफईईएस)
        </h1>
        <img src="drdo-logo.png" alt="DRDO Logo">
    </div>

    <div class="container">
        <h2 style="color:Black  "><?php echo htmlspecialchars($category_name); ?></h2>

        <div class="sort-search-bar">
            <div class="sort-dropdown">
                <label for="sort">Sort by:</label>
                <select id="sort" onchange="sortFiles()">

                    <option value="DESC" <?php echo $sort_order === 'DESC' ? 'selected' : ''; ?>>Newest First</option>
                    <option value="ASC" <?php echo $sort_order === 'ASC' ? 'selected' : ''; ?>>Oldest First</option>
                </select>
            </div>
            <div class="search-bar">
                <form method="GET" action="category.php">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <input type="text" name="search" placeholder="Search files..."
                        value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>


        <div class="container">
            <h2><?php echo htmlspecialchars($category_name); ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Ref Letter Number</th>
                        <th>Ref Letter Date</th>
                        <th>Received From</th>
                        <th>Remarks</th>
                        <th>Action</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($files)): ?>
                        <tr>
                            <td colspan="6">No files found in this category.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($files as $file): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($file['subject']); ?></td>
                                <td><?php echo htmlspecialchars($file['letter_number']); ?></td>
                                <td><?php echo htmlspecialchars($file['letter_date']); ?></td>
                                <td><?php echo htmlspecialchars($file['received_from']); ?></td>
                                <td><?php echo htmlspecialchars($file['remarks']); ?></td>
                                <td class="action-buttons">
                                    <a href="uploads/<?php echo htmlspecialchars($file['file_name']); ?>"
                                        class="btn btn-primary" download>View File</a>
                                    <a href="#" class="btn btn-info"
                                        onclick="showFileInfo('<?php echo $file['id']; ?>')">Info</a>
                                    <?php if ($is_admin): ?>
                                        <a href="edit.php?id=<?php echo $file['id']; ?>" class="btn btn-edit">Edit</a>
                                        <a href="delete.php?id=<?php echo $file['id']; ?>" class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <footer class="footer">
            <div class="logout">
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="viewPage.php">Back</a></li> <!-- Adjusted this link to go back to the view page -->
                </ul>
            </div>
        </footer>

        <!-- Modal to display file information -->
        <div id="infoModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>File Information</h2>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <th>Subject</th>
                            <td id="modalSubject"></td>
                        </tr>
                        <tr>
                            <th>Ref Letter Number</th>
                            <td id="modalLetterNumber"></td>
                        </tr>
                        <tr>
                            <th>Ref Letter Date</th>
                            <td id="modalLetterDate"></td>
                        </tr>
                        <tr>
                            <th>Received From</th>
                            <td id="modalReceivedFrom"></td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td id="modalRemarks"></td>
                        </tr>
                        <tr>
                            <th>Upload Date</th>
                            <td id="modalUploadDate"></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>

        <script>
            function showFileInfo(fileId) {
                // You can fetch file information from server using AJAX if needed
                // For now, simulate displaying file info in modal
                var file = <?php echo json_encode($files); ?>.find(f => f.id == fileId);

                document.getElementById('modalSubject').innerText = file.subject;
                document.getElementById('modalLetterNumber').innerText = file.letter_number;
                document.getElementById('modalLetterDate').innerText = file.letter_date;
                document.getElementById('modalReceivedFrom').innerText = file.received_from;
                document.getElementById('modalRemarks').innerText = file.remarks;
                document.getElementById('modalUploadDate').innerText = file.upload_date;

                // Display the modal
                var modal = document.getElementById('infoModal');
                modal.style.display = 'block';
            }

            function closeModal() {
                // Hide the modal
                var modal = document.getElementById('infoModal');
                modal.style.display = 'none';
            }


            function sortFiles() {
                var sortValue = document.getElementById('sort').value;
                window.location.href = 'category.php?category_id=<?php echo $category_id; ?>&search=<?php echo urlencode($search_query); ?>&sort=' + sortValue;
            }
        </script>
</body>

</html>