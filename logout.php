<?php
  session_start();
  $title = 'Sign Out';
  if (isset($_SESSION['user'])) {
      unset($_SESSION['user']); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    echo "<title>". $title  ."</title>";
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="wrapper bg-white" style="min-height:100vh">
<section class="wrapper bg-white" style="min-height: 70vh">
  <h1> You signed out of your account !</h1>
  <p> Website will redirect you back to our <a href="index.php">homepage</a> in few seconds</p>
  <?php echo "<meta http-equiv=\"refresh\" content=\"7;url=index.php\"/>"; ?>
</section>
</body>
</html>