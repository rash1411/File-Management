<?php
session_start();
require_once ('db.php');

// Check if user is logged in as admin
// if (!isset($_SESSION['user_name'])) { // Use 'user_name' if that's what you're storing in the session
//   header('Location: login.php');
//   exit;
// }

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $subject = $_POST['subject'];
    $letter_number = $_POST['letter_number'];
    $letter_date = $_POST['letter_date'];
    $received_from = $_POST['received_from'];
    $remarks = $_POST['remarks'];
    // $upload_date = $_POST['upload_date'];

    // Update file details in database
    $stmt = $pdo->prepare('UPDATE files SET category_id = ?, subject = ?, letter_number = ?, letter_date = ?, received_from = ?, remarks = ? WHERE id = ?');
    $stmt->execute([$category_id, $subject, $letter_number, $letter_date, $received_from, $remarks, $id]);

    // Redirect to the view page or do something else
    header('Location: viewpage.php');
    exit;
}

// Fetch file details from the database
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM files WHERE id = ?');
$stmt->execute([$id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit File</title>
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
            justify-content: space-between;
            /* background-color: var(--color-black-1);
            color: var(--color-white); */
        }

        .header {
            background-color: brown;
            color: white;
            padding: 15px 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            position: relative;
        }

        .header img {
            height: 50px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        form {
            width: 80%;
            margin: auto;

            background-color: var(--color-black);
            padding: 20px;
            border-radius: 10px;
            position: static;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            /* background-color: var(--color-black-1);
            color: var(--color-white); */
        }

        input[type="submit"] {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            background-color: var(--color-primary);
            color: var(--color-white);
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--color-black);
        }

        .forming {
            position: relative;
            font-size: 25px;
            margin: auto;
            color: white;
        }

        footer {
            background-color: brown;
            color: white;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            left: 0;
            margin-top: 20px;
        }

        .category {
            font-size: 25px;
            color: white;
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

    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($file['id']); ?>">
        <label for="category_id" class="category">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category) {
                $selected = $category['id'] == $file['category_id'] ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($category['id']) . '" ' . $selected . '>' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select><br>
        <div class="forming">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($file['subject']); ?>"
                required><br>

            <label for="letter_number">Letter Number:</label>
            <input type="text" id="letter_number" name="letter_number"
                value="<?php echo htmlspecialchars($file['letter_number']); ?>" required><br>

            <label for="letter_date">Letter Date:</label>
            <input type="date" id="letter_date" name="letter_date"
                value="<?php echo htmlspecialchars($file['letter_date']); ?>" required><br>

            <label for="received_from">Received From:</label>
            <input type="text" id="received_from" name="received_from"
                value="<?php echo htmlspecialchars($file['received_from']); ?>" required><br>

            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"><?php echo htmlspecialchars($file['remarks']); ?></textarea><br>


            <input type="submit" value="Update">
        </div>
    </form>

    <footer>
        <h2>Designed and maintained by QRS&IT group.</h2>
    </footer>
</body>

</html>