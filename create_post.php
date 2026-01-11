<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
require 'db.php';
include 'header.php';

if($_POST){
    $stmt = $pdo->prepare("INSERT INTO posts (user_id,title,content) VALUES (?,?,?)");
    $stmt->execute([$_SESSION['user_id'],$_POST['title'],$_POST['content']]);
    header("Location: home.php");
}
?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-header bg-success text-white"><h4>Create Post</h4></div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
          </div>
          <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Content" rows="5" required></textarea>
          </div>
          <button class="btn btn-success btn-block">Create Post</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
