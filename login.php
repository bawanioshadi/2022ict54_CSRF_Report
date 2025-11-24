<?php
// login.php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $_SESSION['user'] = 'alice';
   
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = 'alice@example.com';
    }
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login - CSRF Demo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1 class="text-center">🔐 Secure Login</h1>
    
    <div class="alert info">
      <strong>Demo Mode:</strong> This is a simulated login for demonstration purposes.
    </div>

    <p class="text-center">Login to access the CSRF demo application and learn about common vulnerabilities and security best practices.</p>

    <form method="post" action="" style="margin-top: 30px;">
      <button type="submit" style="width: 100%;">🚀 Login as Alice</button>
    </form>
  </div>
</body>
</html>
