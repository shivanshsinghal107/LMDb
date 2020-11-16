<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="static/index.css" rel="stylesheet">

  <style>

    .unstyled-button {
      border: none;
      padding: 0;
      background: none;
      }

      .row div{
        padding: 0;
      }

      h2{
        text-align: center;
      }

  </style>
  <title>LMDb</title>
</head>
<body style="background-color: #000; color: white;">
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

  <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color:#C3F4F7;">
    <div class="container-fluid">
      <a class="navbar-brand" href="lmdb.php"><strong>LMDb</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="lmdb.php">Home</a>
          </li>
          <li class="nav-item">
            <?php echo "<a class='nav-link active' href='$page1'>$name1</a>"; ?>
          </li>
          <li class="nav-item">
            <?php echo "<a class='nav-link active' href='$page2'>$name2</a>"; ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              More
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/about">About Us</a>
            </div>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-light" type="submit">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
              <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </nav>
  <br><br><br>

  <h2>Trending Web Series & TV Shows</h2><br>
  <div id="strending" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php

        // connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
        $query = "SELECT * FROM series WHERE type = 'trending'";
        $res = mysqli_query($connection, $query);

        for($i = 0; $i < 8; $i++){
          $row = mysqli_fetch_assoc($res);
          $id = $row['id'];
          $img_name = 'image'.$id.'.jpg';

          if($id == 11){
            echo "<div class='carousel-item active'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          else if($id == 15){
            echo "</div></div></div>";
            echo "<div class='carousel-item'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          echo "<div class='col-sm'>";
          echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
          echo "<button type='submit' class='unstyled-button'><a href='#'>";
          echo "<img class='d-block w-100' src='static/series/$img_name' alt='cover photo'>";
          echo "</a></button></form></div>";
        }
        echo "</div></div></div>";
      ?>
    </div>
    <a class="carousel-control-prev w-auto" href="#strending" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next w-auto" href="#strending" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br><br>
  <h2>Trending Movies</h2><br>
  <div id="mtrending" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php

        // connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
        $query = "SELECT * FROM movies WHERE type = 'trending'";
        $res = mysqli_query($connection, $query);

        for($i = 0; $i < 8; $i++){
          $row = mysqli_fetch_assoc($res);
          $id = $row['id'];
          $img_name = 'image'.$id.'.jpg';

          if($id == 11){
            echo "<div class='carousel-item active'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          else if($id == 15){
            echo "</div></div></div>";
            echo "<div class='carousel-item'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          echo "<div class='col-sm'>";
          echo "<form action='movies.php'><input type='hidden' name='id' value=$id>";
          echo "<button type='submit' class='unstyled-button'><a href='#'>";
          echo "<img class='d-block w-100' src='static/movies/$img_name' alt='cover photo'>";
          echo "</a></button></form></div>";
        }
        echo "</div></div></div>";
      ?>
    </div>
    <a class="carousel-control-prev w-auto" href="#mtrending" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next w-auto" href="#mtrending" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br><br>
  <h2>Top Rated Movies</h2><br>
  <div id="mtoprated" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php

        // connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
        $query = "SELECT * FROM movies WHERE type = 'top_rated'";
        $res = mysqli_query($connection, $query);

        for($i = 0; $i < 8; $i++){
          $row = mysqli_fetch_assoc($res);
          $id = $row['id'];
          $img_name = 'image'.$id.'.jpg';

          if($id == 1){
            echo "<div class='carousel-item active'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          else if($id == 5){
            echo "</div></div></div>";
            echo "<div class='carousel-item'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          echo "<div class='col-sm'>";
          echo "<form action='movies.php'><input type='hidden' name='id' value=$id>";
          echo "<button type='submit' class='unstyled-button'><a href='#'>";
          echo "<img class='d-block w-100' src='static/movies/$img_name' alt='cover photo'>";
          echo "</a></button></form></div>";
        }
        echo "</div></div></div>";
      ?>
    </div>
    <a class="carousel-control-prev w-auto" href="#mtoprated" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next w-auto" href="#mtoprated" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br><br>
  <h2>Top Rated TV Shows</h2><br>
  <div id="stoprated" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php

        // connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
        $query = "SELECT * FROM series WHERE type = 'top_rated'";
        $res = mysqli_query($connection, $query);

        for($i = 0; $i < 8; $i++){
          $row = mysqli_fetch_assoc($res);
          $id = $row['id'];
          $img_name = 'image'.$id.'.jpg';

          if($id == 1){
            echo "<div class='carousel-item active'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          else if($id == 5){
            echo "</div></div></div>";
            echo "<div class='carousel-item'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          echo "<div class='col-sm'>";
          echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
          echo "<button type='submit' class='unstyled-button'><a href='#'>";
          echo "<img class='d-block w-100' src='static/series/$img_name' alt='cover photo'>";
          echo "</a></button></form></div>";
        }
        echo "</div></div></div>";
      ?>
    </div>
    <a class="carousel-control-prev w-auto" href="#stoprated" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next w-auto" href="#stoprated" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br><br>
  <h2>Animes</h2><br>
  <div id="anime" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php

        // connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
        $query = "SELECT * FROM series WHERE type = 'anime'";
        $res = mysqli_query($connection, $query);

        for($i = 0; $i < 8; $i++){
          $row = mysqli_fetch_assoc($res);
          $id = $row['id'];
          $img_name = 'image'.$id.'.jpg';

          if($id == 21){
            echo "<div class='carousel-item active'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          else if($id == 25){
            echo "</div></div></div>";
            echo "<div class='carousel-item'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
          }
          echo "<div class='col-sm'>";
          echo "<form action='series.php'><input type='hidden' name='id' value=$id>";
          echo "<button type='submit' class='unstyled-button'><a href='#'>";
          echo "<img class='d-block w-100' src='static/series/$img_name' alt='cover photo'>";
          echo "</a></button></form></div>";
        }
        echo "</div></div></div>";
      ?>
    </div>
    <a class="carousel-control-prev w-auto" href="#anime" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next w-auto" href="#anime" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
