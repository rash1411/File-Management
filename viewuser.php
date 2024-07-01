<?php
session_start();
require_once ('db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) { // Use 'user_name' if that's what you're storing in the session
    header('Location: viewpage.php');
    exit;
}

// Fetch categories
$categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);



// Fetch categories
$categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);

// Check if a search query is submitted
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>View Files</title>
    <style>
        :root {
            --color-primary: #0073ff;
            --color-white: #f4a261;
            --color-black: #264653;
            --color-black-1: #212b38;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header {
            background-color: brown;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .header img {
            height: 50px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        .container-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .container {
            width: 75%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .box {
            width: 100%;
            max-width: 270px;
            height: 270px;
            border-radius: 20px;
            /* color: white; */
            font-size: 25px;
            text-align: center;
            line-height: 270px;
            margin: 10px;
        }

        .box a {
            text-decoration: none;
            /* color: #000; */
            /* Changed text color to black for better visibility */
            display: block;
            width: 100%;
            height: 100%;
            line-height: 270px;
        }

        .box:hover {
            opacity: 0.8;
            /* Slight opacity change on hover */
            cursor: pointer;
        }

        #box1 {
            background-color: #fdf0d5;
        }

        #box2 {
            background-color: #fff3b0;
        }

        #box3 {
            background-color: #fdf0d5;
        }

        #box4 {
            background-color: #fff3b0;
        }

        #box5 {
            background-color: #fff3b0;
        }

        #box6 {
            background-color: #fdf0d5;
        }

        #box7 {
            background-color: #fff3b0;
        }

        #box8 {
            background-color: #fdf0d5;
        }

        .upload {
            text-align: center;
            text-shadow: 1px 1px 1px #000;
            border-radius: 10px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: brown;
            color: white;
            text-align: center;
            padding: 20px 0;
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

        .heads {
            background-color: #fa7744;
            position: relative;
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            background-color: var(--color-primary);
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-bar button:hover {
            background-color: #0056b3;
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
        <h1>Information security guidelines portal</h1>
    </div>
    <div class="search-bar">
        <form action="search_results.php" method="GET">
            <input type="text" name="search" placeholder="Search for files...">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="container">
        <?php foreach ($categories as $index => $category): ?>
            <div class="box" id="box<?php echo $index + 1; ?>">

                <a
                    href="category.php?category_id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a>
            </div>

        <?php endforeach; ?>
    </div>
    <!-- <div class="upload"><a href="upload.php"><button class="btn">Upload</button></a></div> -->
    <footer>
        <h2>Designed and maintained by QRS&IT group.</h2>
        <div class="logout">
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="javascript:history.back()">Back</a></li>

            </ul>
        </div>
    </footer>
</body>

</html>