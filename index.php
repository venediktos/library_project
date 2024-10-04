<?php include 'db.php';
session_start();


?>

<!DOCTYPE html>

<html lang="en" data-bs-theme = 'light'>
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Project</title>

  </head>

  <body class = "d-flex flex-column min-vh-100" style="background-image: url('/untitled/includes/library_image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

    <?php include("includes\header.php");?>
      <div class="jumbotron text-center mt-5 py-5">
          <h1>My PHP Project</h1>
      </div>

    <div class = "container  py-5 card"  style="width: 30rem">
        <div class="card-body flex-lg-column text-center">
            <h3>Welcome to my project</h3>
            <p>This is an in progress PHP project about a library website. My main purpose is to train on PHP in a fun way, but also get more experience in SQL and get accustomed with bootstrap. Feel free to message me about any mistakes or bugs, and also feel free to fork my repository.</p>
            <b>Any feedback is appreciated.</b>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include("includes/footer.php");?>
  </body>
</html>
