<?php
session_start();
require_once ('db.php');

// Get the search query
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

if (empty($search_query)) {
    echo "No search query provided.";
    exit;
}

// Search for files across all categories
$query = 'SELECT f.*, c.name as category_name FROM files f 
          JOIN categories c ON f.category_id = c.id 
          WHERE f.subject LIKE ? OR f.letter_number LIKE ? OR f.received_from LIKE ? OR f.remarks LIKE ?';
$search_term = '%' . $search_query . '%';
$stmt = $pdo->prepare($query);
$stmt->execute([$search_term, $search_term, $search_term, $search_term]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Search Results</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            min-height: 100vh;
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

        .search-results {
            width: 75%;
            margin: 0 auto;
            padding: 20px 0;
        }

        .search-results h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .result-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .result-item a {
            text-decoration: none;
            color: var(--color-primary);
        }

        .result-item a:hover {
            text-decoration: underline;
        }

        /* .footer {
            position: relative;
            margin-bottom: 0px;
            background-color: white;

        } */
        .footer {
            background-color: brown;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
            left: 0;
            bottom: 0;
            position: absolute;
            width: 100%;
        }

        .logout {
            margin: 30px 0;
        }

        .logout ul {
            display: flex;
            justify-content: right;
            list-style-type: none;
        }

        .logout ul li a {
            color: white;
            margin: 20px;
            text-decoration: none;
            font-size: 1.3em;
            opacity: 0.7;
            transition: 0.5s;
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
    <div class="heads">
        <h1>CYBER SECURITY GUIDELINE PORTAL</h1>
    </div>

    <div class="search-results">
        <h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $result): ?>
                <div class="result-item">
                    <a href="category.php?category_id=<?php echo $result['category_id']; ?>">
                        <?php echo htmlspecialchars($result['subject']); ?> (Category:
                        <?php echo htmlspecialchars($result['category_name']); ?>)
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        <h2>Designed and maintained by QRS&IT group.</h2>
        <div class="logout">
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="back.php">Back</a></li>
            </ul>
        </div>
    </div>
</body>

</html>