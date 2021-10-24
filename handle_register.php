<?php 
session_start();
require_once('conn.php');

if(empty($_POST['username']) || empty($_POST['password'])){
  header('Location: login.php?errCode=1');
  die();
}

$username = $_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$sql= "INSERT INTO alice_blog_admin(username, password) VALUES(?,?)";
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss",$username, $password);
$result =$stmt->execute();
if(!$result){
  die($conn->error);
}


?>