<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }
        .container {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px #ddd;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0275d8;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #025aa5;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Account</h2>

    <form action="register.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" />
        <input type="email" name="email" placeholder="Email Address" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="secret_code" placeholder="Admin Code (optional)">
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
