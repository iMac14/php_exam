<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
require 'db.php';
include 'header.php';

$id = $_GET['id'];

if($_POST){
    $stmt = $pdo->prepare("UPDATE posts SET title=?, content=? WHERE id=? AND user_id=?");
    $stmt->execute([$_POST['title'], $_POST['content'], $id, $_SESSION['user_id']]);
    header("Location: my_posts.php");
}

$post = $pdo->prepare("SELECT * FROM posts WHERE id=? AND user_id=?");
$post->execute([$id, $_SESSION['user_id']]);
$p = $post->fetch();
?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-header bg-warning text-white"><h4>Edit Post</h4></div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" value="<?= $p['title'] ?>" required>
          </div>
          <div class="form-group">
            <textarea name="content" class="form-control" rows="5" required><?= $p['content'] ?></textarea>
          </div>
          <button class="btn btn-warning btn-block">Update Post</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
