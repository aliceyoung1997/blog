<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if(empty($_SESSION['username'])){
    header('Location: index.php');
    exit;
  }
  $sql= "SELECT * FROM alice_blog_articles WHERE is_deleted IS NULL";
  $stmt= $conn->prepare($sql);
  $result = $stmt->execute();
  $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit articles</title>
  <!-- <link rel="stylesheet" href="./stylesheet.css" /> -->
  <link rel="stylesheet" href="./main.css" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
</head>

<body>

  <body class="edit__body">
    <div class="container">
      <nav class="navbar__edit">
        <div class="navbar__title">
          <a href="index.php">Alice's Blog</a>
        </div>
        <div class="navbar__list">
        <a href="all_articles.php" class="navbar__archives">Archives</a>
          <a href="#" class="navbar__about">About</a>
          <a href="#" class="navbar__travel">Travel</a>
          <a href="#" class="navbar__life">Life</a>
        </div>
        <div class="blog__btn">
          <a href="add_articles.php">Add articles</a>
          <a href="logout.php">log out</a>
        </div>
      </nav>
    </div>
    <div class="banner__edit">
      <div class="banner__text">Welcome！</div>
    </div>
    <div class="article__list">
      <?php while($row= $result->fetch_assoc()) {?>
        <div class="article__edit">
          <h2 class="article__edit__title"><?php echo escape($row['title'])?></h2>
          <div class="article__edit__published-time"><?php echo escape($row['created_at'])?></div>
          <a href="edit_article.php?id=<?php echo $row['id']?>" class="edit__btn">編輯</a>
          <a href="delete_article.php?id=<?php echo $row['id'] ?>" class="delete__btn">刪除</a>
        </div>
      <?php } ?>

    </div>
    <footer>
      Copyright © 2021 Alice"s Blog All Rights Reserved.
    </footer>
  </body>

</html>