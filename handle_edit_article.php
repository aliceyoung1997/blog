<?php 
session_start();
require_once('conn.php');

if(
  empty($_POST['content'])|| empty($_POST['title'])
){
  header('Location: edit_article.php?errCode=1&id='.$_POST['id']);
  die();
}

$id= $_POST['id'];
$content= $_POST['content'];
$title = $_POST['title'];
$sql = "UPDATE alice_blog_articles SET content=?,title =? WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param('ssi', $content, $title, $id);
$result = $stmt->execute();
if(!$result){
  die($conn->error);
}
 header('Location: admin.php');

?>