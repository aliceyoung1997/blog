<?php 
session_start();
if(empty($_SESSION['username'])){
    header('Location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="./stylesheet.css" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
</head>

<body class="edit__body">
  <div class="wrapper__log-in">
    <h1>Register</h1>
    
    <form class="log__in" method="POST" action="handle_register.php" >
    <?php 
      if(!empty($_GET['errCode'])){
        $code =$_GET['errCode'];
        $msg = 'ErrMsg';
        if($code === '1'){
          $msg = '資料輸入不齊全';
        }else if ($code === '2'){
          $msg = '帳號或密碼錯誤';
        }
        echo '<h2 class="error">'. $msg . '</h2>';
      }
    ?>
      <label for="username" class="username">USERNAME</label>
      <input type="text" name="username" class="username__input">
      <label for="password" class="password">PASSWORD</label>
      <input type="password" name="password" class="password__input">
      <input type="submit" value="register" class="sign__in__btn">

    </form>
  </div>
</body>

</html>