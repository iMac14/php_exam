<?php
require 'db.php';
$error="";
if ($_POST) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if($user && password_verify($_POST['password'],$user['password'])){
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
include 'header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header text-center"><h4>Login</h4></div>
      <div class="card-body">
        <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="mt-2 text-center">Don't have an account? <a href="register.php">Create Account</a></p>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
