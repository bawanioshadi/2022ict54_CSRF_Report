<?php
// update_secure.php
session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Not authenticated.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Use POST.";
    exit;
}

// Check CSRF token exists both in session and POST
if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token'])) {
    http_response_code(400);
 
    $result = [
        'alert' => 'error',
        'title' => 'CSRF token missing.',
        'details' => 'The token in this request did not match the session token.'
    ];
    renderPage($result);
    exit;
}

// Use hash_equals for timing-safe comparison
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    http_response_code(403);
    $result = [
        'alert' => 'error',
        'title' => 'CSRF validation failed.',
        'details' => 'The token in this request did not match the session token.'
    ];
    renderPage($result);
    exit;
}

$email = $_POST['email'] ?? '';
$email = trim($email);

$result = [
    'alert' => 'error',
    'title' => 'Invalid email.',
    'details' => 'Please provide a valid email address.'
];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email'] = $email;
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $result = [
        'alert' => 'success',
        'title' => "SECURE: Email updated to {$safeEmail}.",
        'details' => 'This change required a valid CSRF token, so forged requests fail.'
    ];
}

renderPage($result);

function renderPage(array $result): void
{
    ?>
    <!doctype html>
    <html>
    <head>
      <meta charset="utf-8">
      <title>Secure Email Update</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <div class="container">
        <h2>✅ Secure Update Endpoint</h2>
        <div class="alert <?php echo htmlspecialchars($result['alert'], ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <p class="text-muted"><?php echo htmlspecialchars($result['details'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="dashboard.php" class="button secondary">← Back to Dashboard</a>
      </div>
    </body>
    </html>
    <?php
}
