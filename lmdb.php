<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LMDb</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <style>
    .unstyled-button {
      border: none;
      padding: 0;
      background: none;
      }

      .carousel-inner .carousel-item-right.active,
      .carousel-inner .carousel-item-next {
        transform: translateX(25%);
      }

      .carousel-inner .carousel-item-left.active,
      .carousel-inner .carousel-item-prev {
        transform: translateX(-25%)
      }

      .carousel-inner .carousel-item-right,
      .carousel-inner .carousel-item-left{
        transform: translateX(0);
      }

      .carousel-control-prev {
        margin-left: -167px;
      }

      .carousel-control-next {
        margin-right: -167px;
      }

  </style>
</head>
<body style="background-color:black;color:white">
  <h1 align="center">Welcome to LMDb!</h1>
  <h1 align="center">WATCH . TRACK . REPEAT</h1><br>
  <?php

    if(isset($_COOKIE['username'])){
      //$logged_in = 1;
      $page1 = "profile.php";
      $name1 = "Profile";
      $page2 = "logout.php";
      $name2 = "Logout";
    }
    else{
      //$logged_in = 0;
      $page1 = "register.html";
      $name1 = "Register";
      $page2 = "login.html";
      $name2 = "Login";
    }

  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="desktop-navbar">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="lmdb.php">Home</a>
        </li>
        <li class="nav-item active">
          <?php echo "<a class='nav-link' href='$page1'>$name1</a>"; ?>
        </li>
        <li class="nav-item active">
          <?php echo "<a class='nav-link' href='$page2'>$name2</a>"; ?>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            More
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/about">About Us</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <form action="" method="post">
    <input type="text" name="search" class="form-control" id="search" placeholder="Search">
    <br>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  <br>
  <div class="container text-center my-3">
    <h2>Trending Web Series & TV Shows</h2><br>
    <div class="row mx-auto my-auto">
      <div id="strending" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php

            // connect to the database
            $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
            $query = "SELECT * FROM `series` WHERE type = 'trending'";
            $res = mysqli_query($connection, $query);

            for($i = 0; $i < mysqli_num_rows($res); $i++){
              $row = mysqli_fetch_assoc($res);
              $id = $row['id'];
              $img_name = 'image'.$id.'.jpg';
              if($id == 11)
                $active = ' active';
              else
                $active = '';

              echo "<div class='carousel-item$active'>";
              echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
              echo "<button type='submit' class='unstyled-button'><a href='#'>";
              echo "<img class='img-fluid' src='series/$img_name' style='width:350px;height:400px;' alt='cover photo'>";
              echo "</a></button></form></div>";
            }
          ?>
        </div>
        <a class="carousel-control-prev w-auto" href="#strending" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#strending" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br>
  <div class="container text-center my-3">
    <h2>Trending Movies</h2><br>
    <div class="row mx-auto my-auto">
      <div id="mtrending" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
            $query = "SELECT * FROM `movies` WHERE type = 'trending'";
            $res = mysqli_query($connection, $query);

            for($i = 0; $i < mysqli_num_rows($res); $i++){
              $row = mysqli_fetch_assoc($res);
              $id = $row['id'];
              $img_name = 'image'.$id.'.jpg';
              if($id == 11)
                $active = ' active';
              else
                $active = '';

              echo "<div class='carousel-item$active'>";
              echo "<form action='movies.php'><input type='hidden' name='id' value=$id>";
              echo "<button type='submit' class='unstyled-button'><a href='#'>";
              echo "<img class='img-fluid' src='movies/$img_name' style='width:350px;height:400px;' alt='cover photo'>";
              echo "</a></button></form></div>";
            }
          ?>
        </div>
        <a class="carousel-control-prev w-auto" href="#mtrending" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#mtrending" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br>
  <div class="container text-center my-3">
    <h2>Top Rated Movies</h2><br>
    <div class="row mx-auto my-auto">
      <div id="mtoprated" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
            $query = "SELECT * FROM `movies` WHERE type = 'top_rated'";
            $res = mysqli_query($connection, $query);

            for($i = 0; $i < mysqli_num_rows($res); $i++){
              $row = mysqli_fetch_assoc($res);
              $id = $row['id'];
              $img_name = 'image'.$id.'.jpg';
              if($id == 1)
                $active = ' active';
              else
                $active = '';

              echo "<div class='carousel-item$active'>";
              echo "<form action='movies.php'><input type='hidden' name='id' value=$id>";
              echo "<button type='submit' class='unstyled-button'><a href='#'>";
              echo "<img class='img-fluid' src='movies/$img_name' style='width:350px;height:400px;' alt='cover photo'>";
              echo "</a></button></form></div>";
            }
          ?>
        </div>
        <a class="carousel-control-prev w-auto" href="#mtoprated" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#mtoprated" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br>
  <div class="container text-center my-3">
    <h2>Top Rated TV Shows</h2><br>
    <div class="row mx-auto my-auto">
      <div id="stoprated" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
            $query = "SELECT * FROM `series` WHERE type = 'top_rated'";
            $res = mysqli_query($connection, $query);

            for($i = 0; $i < mysqli_num_rows($res); $i++){
              $row = mysqli_fetch_assoc($res);
              $id = $row['id'];
              $img_name = 'image'.$id.'.jpg';
              if($id == 1)
                $active = ' active';
              else
                $active = '';

              echo "<div class='carousel-item$active'>";
              echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
              echo "<button type='submit' class='unstyled-button'><a href='#'>";
              echo "<img class='img-fluid' src='series/$img_name' style='width:350px;height:400px;' alt='cover photo'>";
              echo "</a></button></form></div>";
            }
          ?>
        </div>
        <a class="carousel-control-prev w-auto" href="#stoprated" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#stoprated" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br>
  <div class="container text-center my-3">
    <h2>Animes</h2><br>
    <div class="row mx-auto my-auto">
      <div id="anime" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
            $query = "SELECT * FROM `series` WHERE type = 'anime'";
            $res = mysqli_query($connection, $query);

            for($i = 0; $i < mysqli_num_rows($res); $i++){
              $row = mysqli_fetch_assoc($res);
              $id = $row['id'];
              $img_name = 'image'.$id.'.jpg';
              if($id == 21)
                $active = ' active';
              else
                $active = '';

              echo "<div class='carousel-item$active'>";
              echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
              echo "<button type='submit' class='unstyled-button'><a href='#'>";
              echo "<img class='img-fluid' src='series/$img_name' style='width:350px;height:400px;' alt='cover photo'>";
              echo "</a></button></form></div>";
            }
          ?>
        </div>
        <a class="carousel-control-prev w-auto" href="#anime" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#anime" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  <script>
    $('#strending').carousel({
      interval: 3000
    });

    $('#mtrending').carousel({
      interval: 3000
    });

    $('#mtoprated').carousel({
      interval: 3000
    });

    $('#stoprated').carousel({
      interval: 3000
    });

    $('#anime').carousel({
      interval: 3000
    });

    $('.carousel .carousel-item').each(function(){
        var next = $(this).next();
        if (!next.length) {
        next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<2;i++) {
            next=next.next();
            if (!next.length) {
            	next = $(this).siblings(':first');
          	}

            next.children(':first-child').clone().appendTo($(this));
          }
    });
  </script>
</body>
</html>
