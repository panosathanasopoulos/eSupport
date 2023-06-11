<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="view/js/my.js"></script>
  <link rel="stylesheet" href="view/css/my.css">
</head>
<body> 
<div class="container-fluid" >
<?php
 
 include $menu;
 ?>
<div class="container" style='min-height:70vh; padding:30px;'>

<hr>
 <?php
 include $page;
 
 ?>
</div>
<footer style='height:20vh;background-color:black; color:white; padding:50px;text-align:center'>
<h2>Copyright : WEBIA ACADEMY </h2>

</footer>
</body>
</html>
