<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($mysqli, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Pemrograman Web</title>
    <style>
        /* General Page Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the login form */
        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
        }

        /* Header text */
        .login-text {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Input Fields Styling */
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #2a5298;
            box-shadow: 0 0 5px rgba(42, 82, 152, 0.5);
        }

        /* Button Styling */
        .btn {
            background: #2a5298;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #1e3c72;
        }

        /* Register link text */
        .login-register-text {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .login-register-text a {
            color: #2a5298;
            text-decoration: none;
            font-weight: bold;
        }

        .login-register-text a:hover {
            text-decoration: underline;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .login-text {
                font-size: 1.5rem;
            }

            .btn {
                font-size: 14px;
            }

            .input-group input {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Daftar</a></p>
        </form>
    </div>
</body>
</html>
