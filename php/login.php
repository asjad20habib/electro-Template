<?php
session_start();
include 'db.php';
// require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $pass  = $_POST['password'] ?? '';

    // 1. Empty check
    if ($email === '' || $pass === '') {
        echo "All fields are required";
        exit;
    }

    // 2. Find user by email
    $sql  = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $res  = $stmt->fetch();

    // 3. User not found
    if (!$res) {
        echo "User not found";
        exit;
    }

    // 4. Verify password
    if (!password_verify($pass, $res['password'])) {
        echo "Incorrect password";
        exit;
    }
 
    // 6. Create session
    $_SESSION['user_id']  = $res['id'];
    $_SESSION['is_admin'] = $res['is_admin'];

    // 7. Redirect based on role
    if ($_SESSION['is_admin'] == 1) {
        header("Location: ../dashboards.php");
    } 
    else {
        header("Location: ../index2.php");
    }


    if($_POST['remember_me'] ){
        $token = bin2hex(random_bytes(32));
        // $token = rand(1000, 9999);  // 4-digit random number
        $sql = "UPDATE users SET remember_me = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token, $email]);
        $cookie = setcookie("remember_token", $token, time() + 86400, "/");

         

    }



    exit;
}
?>
