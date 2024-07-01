<?php
session_start();
require_once ('db.php');

// Check if user is logged in as admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');

}
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $subject = $_POST['subject'];
    $letter_number = $_POST['letter_number'];
    $letter_date = $_POST['letter_date'];
    $received_from = $_POST['received_from'];
    $remarks = $_POST['remarks'];

    // File upload handling
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];

    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array('pdf', 'doc', 'docx', 'txt'); // Add more if needed

    if (in_array($file_ext, $allowed_extensions)) {
        if ($file_error === 0) {
            if ($file_size <= 5242880) { // 5MB limit
                $file_destination = 'uploads/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {

                    // Insert file details into database
                    $stmt = $pdo->prepare('INSERT INTO files (category_id, subject, letter_number, letter_date, received_from, remarks, file_name) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $stmt->execute([$category_id, $subject, $letter_number, $letter_date, $received_from, $remarks, $file_name]);

                    // Redirect to a success page or do something else
                    header('Location: viewpage.php');
                    exit;
                } else {
                    echo "Failed to move uploaded file.";
                }
            } else {
                echo "File size exceeds limit (5MB).";
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo '<script>alert("Invalid file type. Allowed types: ' . implode(', ', $allowed_extensions) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload File</title>
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
            position: relative;
        }

        .header img {
            height: 50px;
        }

        .register {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .sub {
            text-align: right;
            justify-content: center;
        }

        #table_head {
            color: chocolate;
            text-align: center;
        }

        form {
            width: 60%;
            margin: 20px 0;
            background-color: var(--color-black);
            padding: 20px;
            border-radius: 10px;
        }

        form table {
            width: 100%;
            border-collapse: collapse;
        }

        form table td {
            padding: 10px;
        }

        form input,
        form select,
        form button,
        form textarea {
            font-size: 14px;
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            /* background-color: var(--color-black-1);
            color: var(--color-white); */
            border: none;
            border-radius: 5px;
        }

        form button {
            background-color: var(--color-primary);
            color: white;
            border: none;
            cursor: pointer;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 25px;
            /* transition: background-color 0.3s ease; */
        }

        /* 
        form button:hover {
            background-color: var(--color-black);
        } */

        footer {
            background-color: brown;
            margin-top: 10px;
            color: white;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            left: 0;
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

        .forming {
            position: relative;
            font-size: 25px;
            margin: auto;
            color: white;
        }



        /* experiment */
    </style>
</head>

<body>

    <div class="header"><img src="drdo-logo.png" alt="DRDO Logo">
        <h1>Centre for Fire, Explosive and Environment Safety (CFEES)<br>
            अग्नि, विस्फोटक और पर्यावरण सुरक्षा केंद्र (सीएफईईएस)
        </h1>
        <img src="drdo-logo.png" alt="DRDO Logo">
    </div>

    <div class="register">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <table>
                <h2 id="table_head">Guideline Upload Form</h2>
                <tr>
                    <td><label for="category_id" style="color: white; font-size: 25px">Category:</label></td>
                    <td>
                        <select name="category_id" id="category_id" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $category) {
                                echo '<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['name']) . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <div class="forming">
                    <tr>
                        <td><label for="subject" style="color: white; font-size: 25px">Subject:</label></td>
                        <td><input type="text" id="subject" name="subject" required></td>
                    </tr>
                    <tr>
                        <td><label for="letter_number" style="color: white; font-size: 25px">Ref Letter Number:</label>
                        </td>
                        <td><input type="text" id="letter_number" name="letter_number" required></td>
                    </tr>
                    <tr>
                        <td><label for="letter_date" style="color: white; font-size: 25px">Ref Letter Date:</label></td>
                        <td><input type="date" id="letter_date" name="letter_date" required></td>
                    </tr>
                    <tr>
                        <td><label for="received_from" style="color: white; font-size: 25px">Received From:</label>
                        </td>
                        <td><input type="text" id="received_from" name="received_from" required></td>
                    </tr>
                    <tr>
                        <td><label for="remarks" style="color: white; font-size: 25px">Remarks:</label></td>
                        <td><textarea name="remarks" id="remarks"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="file" style="color: white; font-size: 25px">Select File:</label></td>
                        <td><input type="file" id="file" name="file" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button type="submit">Upload</button>
                        </td>
                    </tr>
                </div>
            </table>
        </form>
    </div>

    <footer>
        <h2>Designed and maintained by QRS&IT group.</h2>
        <div class="logout">
            <ul>
                <li><a href="logout.php">Logout</a> <span>|</span></li>
                <li><a href="viewpage.php">Back</a></li>
            </ul>
        </div>
    </footer>

</body>

</html>