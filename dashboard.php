<?php
// dashboard.php
session_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard - CSRF Demo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>📊 Dashboard</h1>

    <?php if (isset($_SESSION['user'])): ?>
      <div class="user-info">
        <p><strong>👤 Logged in as:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?></p>
        <p><strong>📧 Current email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? 'not set'); ?></p>
      </div>

      <p style="margin-bottom: 25px; color: #666;">Choose one of the options below to test CSRF vulnerabilities:</p>

      <ul>
        <li>
          <a href="vulnerable_form.php">❌ Vulnerable Form <span class="badge vulnerable">NO PROTECTION</span></a>
          <p style="margin-top: 8px; font-size: 13px; color: #999;">Update email without CSRF token protection</p>
        </li>
        <li>
          <a href="secure_form.php">✅ Secure Form <span class="badge secure">PROTECTED</span></a>
          <p style="margin-top: 8px; font-size: 13px; color: #999;">Update email with CSRF token (Synchronizer Token Pattern)</p>
        </li>
        <li>
          <a href="logout.php">🚪 Logout</a>
        </li>
      </ul>
    <?php else: ?>
      <div class="alert info">
        <strong>Not logged in</strong> — You need to login to access the demo.
      </div>
      <a href="login.php" class="button" style="display: inline-block; margin-top: 20px;">🔐 Go to Login</a>
    <?php endif; ?>
  </div>
</body>
</html>
