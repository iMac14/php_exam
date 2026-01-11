<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
require 'db.php';
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=? ORDER BY id DESC");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll();
?>
<h2>My Posts</h2>
<?php foreach($posts as $p): ?>
<div class="card mb-2">
  <div class="card-body">
    <h5><?= $p['title'] ?></h5>
    <p><?= $p['content'] ?></p>
    <a href="edit_post.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
    <a href="delete_post.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
  </div>
</div>
<?php endforeach; ?>
<?php include 'footer.php'; ?>
