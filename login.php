<?php
session_start();

$error_message = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? '';

    $conn = mysqli_connect("localhost", "root", "", "file_management");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM id_emp WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) { // Plain text comparison
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['user_type'];
            // Ensure this is set to 'admin' for admin users

            if ($row['user_type'] === 'admin') {
                header('Location: viewpage.php');
            } else {
                header('Location: viewuser.php');
            }
            exit;
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General styles */
        body {
            background-color: #e9ecef;
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
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

        .main-content {
            display: flex;
            flex-grow: 1;
            flex-wrap: wrap;
            padding: 30px;
            box-sizing: border-box;
        }

        .image-container {
            flex: 0 0 30%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .image-container h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 50px;
            text-align: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .login-container {
            flex: 0 0 70%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        .formerror {
            color: red;
        }


        .btn {
            display: block;
            width: 100%;
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

        .error-message {
            color: #dc3545;
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            padding: 8px;
            border-radius: 6px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        footer {
            background-color: brown;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        /* Responsive styles */
        @media (max-width: 768px) {

            .image-container,
            .login-container {
                flex: 1 1 100%;
            }

            .image-container h1 {
                font-size: 20px;
            }

            .login-box h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .header h1 {
                font-size: 18px;
            }

            .header img {
                height: 40px;
            }

            .login-box h2 {
                font-size: 18px;
            }

            .form-group label {
                font-size: 14px;
            }

            .form-group input[type="text"],
            .form-group input[type="password"],
            .btn {
                font-size: 14px;
            }
        }

        /* h1{ font-size: 1000px; margin: .67em 0 } */
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
    <div class="main-content">
        <div class="image-container">
            <h1>Cyber Security</h1>
            <img src="img.png" alt="Image">
        </div>
        <div class="login-container">
            <div class="login-box">
                <h2>Login</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="myform" method="post"
                    onsubmit="return validateForm()">
                    <div class="form-group" id="username">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required><b><span class="formerror">
                            </span></b>
                    </div>
                    <div class="form-group" id="password">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><b><span class="formerror">
                            </span></b>
                    </div>
                    <input type="submit" class="btn" name="login" value="Login">
                </form>
                <?php if ($error_message): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer>
        <h3>Designed and maintained by QRS&IT group.</h3>
    </footer>
    <script src="script.js"></script>
</body>

</html>