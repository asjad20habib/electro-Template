<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .login-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 350px;
        }

        /* Form Heading */
        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        /* Input Fields */
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Submit Button */
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }

        /* Extra links */
        .login-container .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }

        .login-container .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php
        // ✅ Error messages show karo
        if (isset($_GET['error'])) {
            $errors = [
                'empty_fields'   => 'Email aur password dono zaroori hain.',
                'user_not_found' => 'Yeh email registered nahi hai.',
                'wrong_password' => 'Password galat hai.',
            ];
            $msg = $errors[$_GET['error']] ?? 'Kuch error hua, dobara try karo.';
            echo '<p style="color:red;text-align:center;margin-bottom:10px;">' . $msg . '</p>';
        }
        if (isset($_GET['success'])) {
            echo '<p style="color:green;text-align:center;margin-bottom:10px;">Account ban gaya! Ab login karo.</p>';
        }
        ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <!-- ✅ Fix: Role dropdown hata diya — admin role sirf DB se aata hai -->
            <label style="font-size:14px;display:flex;align-items:center;gap:8px;margin-bottom:14px;">
                <input type="checkbox" name="remember_me" value="1"> Remember Me
            </label>
            <button type="submit">Login</button>
        </form>
        <a class="register-link" href="reg.php">Don't have an account? Register</a>
    </div>

</body>
</html>