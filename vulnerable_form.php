<?php
// vulnerable_form.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Vulnerable Form - CSRF Demo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>❌ Vulnerable Email Update Form</h2>
    
    <div class="alert warning">
      <strong>⚠️ No CSRF Protection:</strong> This form is vulnerable to Cross-Site Request Forgery attacks.
    </div>

    <div class="user-info">
      <p><strong>Current email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    </div>

    <form action="update_vulnerable.php" method="POST">
      <label for="email">New Email Address:</label>
      <input type="email" id="email" name="email" required>
      <button type="submit">🔄 Update Email</button>
    </form>

    <div style="margin-top: 30px;">
      <a href="dashboard.php" class="button secondary">← Back to Dashboard</a>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;" class="text-muted">
      <strong>Why is this vulnerable?</strong> This form lacks a CSRF token, making it susceptible to attacks from malicious websites.
    </p>
  </div>
</body>
</html>
