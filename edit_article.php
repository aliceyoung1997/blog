<?php
session_start();
require_once('conn.php');

$id=$_GET['id'];
$stmt= $conn->prepare(
  "SELECT * FROM alice_blog_articles WHERE id=?"
);
$stmt->bind_param("i", $id);
$result = $stmt->execute();
$result = $stmt->get_result();
$row= $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
</head>

<body class="edit__body">
  <div class="container">
    <nav class="navbar__edit">
      <div class="navbar__title">
        <a href="index.php">Alice's Blog</a>
      </div>
      <div class="navbar__list">
        <a href="index.php" class="navbar__about">About</a>
        <a href="#" class="navbar__travel">Travel</a>
        <a href="#" class="navbar__life">Life</a>
      </div>
      <div class="blog__btn">
        <a href="admin.php">Back end</a>
        <a href="logout.php">log out</a>
      </div>
    </nav>
  </div>
  <div class="banner__edit">
    <div class="banner__text">Welcome！</div>
  </div>
  <form class="article__add" method="POST" action="handle_edit_article.php">
    <?php 
      if(!empty($_GET['errCode'])){
        $code =$_GET['errCode'];
        $msg = 'ErrMsg';
        if($code === '1'){
          $msg = '資料輸入不齊全';
        }
        echo '<h2 class="error">'. $msg . '</h2>';
      }
    ?>
    <h2>編輯文章：</h2>
    <input type="text" placeholder="請輸入文章標題" class="article__add__title" name="title" value=<?php echo $row['title']?>>
    <textarea rows="30" class="article__add__content" name="content">
    <?php 
      echo $row['content']
    ?>
    </textarea>
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
    <input type="submit" value="送出文章" class="submit__article">

  </form>
  <footer>
    Copyright © 2021 Alice"s Blog All Rights Reserved.
  </footer>
</body>

</html>