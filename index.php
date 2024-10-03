<?php include 'db.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en" data-bs-theme = 'light'>
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <title>Project</title>

  </head>
  <body style="background-image: url('/untitled/includes/library_image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

  <?php include("includes\header.php");?>


  <div class="jumbotron text-center">
      <h1>My First Bootstrap Page</h1>
      <p>Resize this responsive page to see the effect!</p>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-sm-4">
              <h3>Column 1</h3>
              <p>Lorem ipsum dolor..</p>
          </div>
          <div class="col-sm-4">
              <h3>Column 2</h3>
              <p>Lorem ipsum dolor..</p>
          </div>
          <div class="col-sm-4">
              <h3>Column 3</h3>
              <p>Lorem ipsum dolor..</p>
          </div>
      </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
