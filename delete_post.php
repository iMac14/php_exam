<?php
session_start();
require 'db.php';

$stmt = $pdo->prepare("DELETE FROM posts WHERE id=? AND user_id=?");
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);
header("Location: my_posts.php");
