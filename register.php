<?php
require 'db.php';
$error = $success = "";

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($name) || empty($email) || empty($password)){
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            $error = "Email already registered.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $success = "Registration successful! <a href='login.php'>Login here</a>";
        }
    }
}
include 'header.php';
?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-header bg-primary text-white text-center"><h4>Register</h4></div>
      <div class="card-body">
        <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>
        <form method="POST">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary btn-block">Register</button>
        </form>
        <p class="mt-2 text-center">Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
