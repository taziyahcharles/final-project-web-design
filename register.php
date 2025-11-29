<?php
require 'includes/db.php';
$msg='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    if ($name && $email && $pass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
        try {
            $stmt->execute([$name,$email,$hash]);
            $msg='Registered. You may log in.';
        } catch (Exception $e) { $msg='Error: '.$e->getMessage(); }
    } else $msg='Fill all fields';
}
include 'includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3>Register</h3>
    <?php if($msg): ?><div class="alert alert-info"><?=$msg?></div><?php endif; ?>
    <form method="post" novalidate>
      <input name="name" class="form-control mb-2" placeholder="Name" required>
      <input name="email" class="form-control mb-2" placeholder="Email" type="email" required>
      <input name="password" class="form-control mb-2" placeholder="Password" type="password" required>
      <button class="btn btn-success">Create account</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>