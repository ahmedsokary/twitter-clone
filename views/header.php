<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Twitter</title>
    <!--link to style sheet -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

  </head>
  <body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Twitter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
    <li class="nav-item">
        <a class="nav-link" href="?page=timeline">Your time line</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtweets">your tweets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=publicprofiles">Public profiles</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        
         <!--the button here open the model when botton is clicked -->
         <?php if ($_SESSION['id']) { ?>
      
      <a class="btn btn-success-outline" href="?function=logout">Logout</a>
    
    <?php } else { ?>
    
      <button data-toggle="modal" data-target="#exampleModalLong" class="btn btn-outline-success my-2 my-sm-0">Login/Signup</button>
    
    <?php } ?>
       
</div>
  </div>
</nav>

