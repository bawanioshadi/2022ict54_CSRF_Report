<?php
// secure_form.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Generate a CSRF token per session (if not present). You may also prefer to generate per-form tokens.
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$token = $_SESSION['csrf_token'];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Secure Form - CSRF Demo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>✅ Secure Email Update Form</h2>
    
    <div class="alert success">
      <strong>🛡️ CSRF Protected:</strong> This form uses the Synchronizer Token Pattern to prevent CSRF attacks.
    </div>

    <div class="user-info">
      <p><strong>Current email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    </div>

  <form action="update_secure.php" method="POST">
      <label for="email">New Email Address:</label>
      <input type="email" id="email" name="email" required>
      <!-- Hidden CSRF token field -->
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
      <button type="submit">🔄 Update Email (Secure)</button>
    </form>

    <div style="margin-top: 30px;">
      <a href="dashboard.php" class="button secondary">← Back to Dashboard</a>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;" class="text-muted">
      <strong>How is this protected?</strong> This form includes a unique CSRF token that must match the one stored on the server. Attackers cannot forge this token from external sites.
    </p>
  </div>
</body>
</html>
