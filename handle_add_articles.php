<?php 
session_start();
require_once('conn.php');

if(empty($_POST['content']) || empty($_POST['title'])){
  header('Location: add_articles.php?errCode=1');
  die();
}

$content = $_POST['content'];
$title =$_POST['title'];
$sql = "INSERT INTO alice_blog_articles(title,content) value(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $title, $content);
$result = $stmt->execute();
if(!$result){
  die($conn->error);
}

header("Location: admin.php");


?>