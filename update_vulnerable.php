<?php
// update_vulnerable.php
session_start();

// Must be logged in for action to succeed
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Not authenticated.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Use POST.";
    exit;
}

$email = $_POST['email'] ?? '';
$email = trim($email);

// Insecure: no CSRF protection, and minimal validation 
$pageTitle = 'Vulnerable Email Update';
$alertClass = 'warning';
$message = 'Invalid email.';
$updatedEmail = null;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email'] = $email;// Direct update without verification
    $alertClass = 'error';
    $updatedEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $message = "VULNERABLE: Email updated to {$updatedEmail}.";
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>❌ Vulnerable Update Endpoint</h2>

    <div class="alert <?php echo $alertClass; ?>">
      <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
    </div>

    <?php if ($updatedEmail): ?>
      <p class="text-muted">This endpoint accepted a cross-site request because it does not verify intent.</p>
    <?php endif; ?>

    <a href="dashboard.php" class="button secondary">← Back to Dashboard</a>
  </div>
</body>
</html>
