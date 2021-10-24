<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $sql="SELECT * FROM alice_blog_articles ORDER BY id DESC";
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
  <title>Alice's Blog</title>
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
</head>

<body>
  <div class="container">
    <nav>
      <div class="navbar__title">
        <a href="index.php">Alice's Blog</a>
      </div>
      <div class="navbar__list">
        <a href="#" class="navbar__about">About</a>
        <a href="#" class="navbar__travel">Travel</a>
        <a href="#" class="navbar__life">Life</a>
      </div>
      <div class="blog__btn">
      <?php if(empty($_SESSION['username'])){?>
        <a href="login.php">log in</a>
      <?php } else { ?>
        <a href="admin.php">Admin</a>
        <a href="add_articles.php">Add articles</a>
        <a href="logout.php">log out</a>
     <?php } ?>
      </div>
    </nav>
    <div class="banner"></div>
    <?php 
      while($row = $result->fetch_assoc()){ ?>
    <div class="article">
      <h1 class="article__title"><?php echo escape($row['title']); ?></h1>
      <div class="article__published-time">
        <?php echo escape($row['created_at']); ?>
      </div>
      <div class="article__content"><?php echo escape($row['content']); ?>
      </div>
      <a href="page.php?id=<?php echo $row['id']?>" class="article__read-btn">READ MORE</a>
    </div>
   <?php  } ?>

  </div>
  <footer>
    Copyright © 2021 Alice"s Blog All Rights Reserved.
  </footer>
</body>

</html>