<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="home.php">MyBlog</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user_id'])): ?>
      <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="create_post.php">Create Post</a></li>
      <li class="nav-item"><a class="nav-link" href="my_post.php">My Posts</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      <?php else: ?>
      <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<div class="container mt-4">
