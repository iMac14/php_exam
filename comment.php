<?php
session_start();
require 'db.php';

$stmt = $pdo->prepare("INSERT INTO comments (post_id,user_id,comment) VALUES (?,?,?)");
$stmt->execute([$_POST['post_id'], $_SESSION['user_id'], $_POST['comment']]);

header("Location: home.php");
