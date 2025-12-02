<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'config/db.php';

$msg = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($pass)) {
        $msg = 'Please fill all fields';
        $msg_type = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please enter a valid email address';
        $msg_type = 'danger';
    } elseif (strlen($pass) < 6) {
        $msg = 'Password must be at least 6 characters long';
        $msg_type = 'danger';
    } else {
        // Check if email already exists
        $checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $checkStmt->execute([$email]);
        
        if ($checkStmt->fetch()) {
            $msg = 'Email already registered';
            $msg_type = 'danger';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            // Removed 'role' from the INSERT statement
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            
            try {
                $stmt->execute([$name, $email, $hash]);
                $msg = 'Registration successful! You can now log in.';
                $msg_type = 'success';
                
                // Auto-login after registration (optional)
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['user_role'] = 'user'; // Default role
                
                // Redirect to home page
                header("Location: index.php");
                exit;
                
            } catch (PDOException $e) {
                $msg = 'Error: ' . $e->getMessage();
                $msg_type = 'danger';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register - Pet Haven</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5 p-4 bg-white shadow rounded">

      <h3 class="mb-3 text-center">Create an Account</h3>

      <?php if($msg && !isset($_SESSION['user_id'])): ?>
        <div class="alert alert-<?= $msg_type ?> text-center"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <?php if(isset($_SESSION['user_id'])): ?>
        <div class="alert alert-success text-center">
          Registration successful! Redirecting to home page...
        </div>
        <script>
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 2000);
        </script>
      <?php else: ?>
        <form method="post" novalidate>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input name="name" class="form-control" placeholder="Enter your name" 
                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input name="email" type="email" class="form-control" placeholder="Enter your email" 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" placeholder="At least 6 characters" required>
            <small class="text-muted">Minimum 6 characters</small>
          </div>

          <button class="btn btn-success w-100">Create Account</button>
        </form>

        <div class="text-center mt-3">
          <a href="login.php">Already have an account? Login here</a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>

</body>
</html>