<?php
session_start();
require 'config/db.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, name, password, role FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($u && password_verify($pass, $u['password'])) {
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['user_name'] = $u['name'];
        $_SESSION['user_role'] = $u['role'];
        header("Location: index.php");
        exit;
    } else {
        $msg = "Invalid credentials";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - Pet Haven</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5 p-4 bg-white shadow rounded">

      <h3 class="mb-3 text-center">Login</h3>

      <?php if($msg): ?>
        <div class="alert alert-danger text-center"><?=$msg?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Login</button>
      </form>

      <div class="text-center mt-3">
        <a href="register.php">Don't have an account? Register</a>
      </div>

    </div>
  </div>
</div>

</body>
</html>
