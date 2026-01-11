<?php
session_start();
require 'db.php';

$id = $_GET['id'];

if ($_POST) {
    $stmt = $pdo->prepare("UPDATE posts SET title=?, content=? WHERE id=? AND user_id=?");
    $stmt->execute([$_POST['title'], $_POST['content'], $id, $_SESSION['user_id']]);
    header("Location: my_posts.php");
}

$post = $pdo->prepare("SELECT * FROM posts WHERE id=?");
$post->execute([$id]);
$p = $post->fetch();
?>
<form method="POST">
<input name="title" value="<?= $p['title'] ?>">
<textarea name="content"><?= $p['content'] ?></textarea>
<button>Update</button>
</form>
