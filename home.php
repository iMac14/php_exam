<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
require 'db.php';
include 'header.php';

$posts = $pdo->query("
    SELECT posts.*, users.name 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.id DESC
")->fetchAll();
?>

<h2>Welcome, <?= $_SESSION['name'] ?></h2>

<?php foreach($posts as $p): ?>
<div class="card mb-3 shadow">
  <div class="card-body">
    <h5 class="card-title"><?= $p['title'] ?></h5>
    <h6 class="card-subtitle mb-2 text-muted">By <?= $p['name'] ?> | <?= $p['created_at'] ?></h6>
    <p class="card-text"><?= $p['content'] ?></p>

    <form method="POST" action="comment.php">
      <input type="hidden" name="post_id" value="<?= $p['id'] ?>">
      <div class="input-group mb-2">
        <input type="text" name="comment" class="form-control" placeholder="Write a comment" required>
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Comment</button>
        </div>
      </div>
    </form>

    <?php
    $comments = $pdo->prepare("
        SELECT users.name, comment 
        FROM comments 
        JOIN users ON comments.user_id = users.id 
        WHERE post_id=? 
        ORDER BY comments.id ASC
    ");
    $comments->execute([$p['id']]);
    foreach($comments as $c){
        echo "<small><strong>{$c['name']}</strong>: {$c['comment']}</small><br>";
    }
    ?>
  </div>
</div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>
