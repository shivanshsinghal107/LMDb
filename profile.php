<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="static/index.css" rel="stylesheet">

  <style>
    h2{
      text-align: center;
      padding-top: 30px;
    }

    .card-body{
      background-color: #000;
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

  <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color:#7FFFD4;">
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
  <br><br>

  <?php

  $username = $_COOKIE['username'];
  echo "<h2>$username's Profile</h2>";

  // connect to the database
  $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
  $query = "SELECT time, rating, review, type, mid AS id FROM mreviews WHERE username = '$username' UNION SELECT time, rating, review, type, sid AS id FROM sreviews WHERE username = '$username' ORDER BY time DESC";
  $res = mysqli_query($connection, $query);

  if($res){
    echo "<div class='container-fluid'>";
    echo "<div class='row'><div class='row gy-4'>";
    for($i = 0; $i < mysqli_num_rows($res); $i++){
      $row = mysqli_fetch_assoc($res);
      if($row['type'] == 'movies'){
        $id = $row['id'];
        $que = "SELECT * FROM movies WHERE id = '$id'";
        $img = "static/movies/image".$id.".jpg";
        $action = "movies.php";
      }
      else{
        $id = $row['id'];
        $que = "SELECT * FROM series WHERE id = '$id'";
        $img = "static/series/image".$id.".jpg";
        $action = "series.php";
      }
      $rating = $row['rating'];
      $review = $row['review'];

      $result = mysqli_query($connection, $que);
      $content = mysqli_fetch_assoc($result);

      $name = $content['name'];

      echo "<div class='col-md-3 col-12'>";
      echo "<div class='card'>";
      echo "<img src='$img' class='card-img-top' style='height:480px;' alt='cover photo'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>$rating</h5>";
      echo "<p class='card-text'>$review</p>";
      echo "<form action='$action'><input type='hidden' name='id' value=$id>";
      echo "<button type='submit' class='btn btn-primary'>$name</button></form>";
      echo "</div></div></div>";
    }
    echo "</div></div></div></div><br>";
  }
  else
    echo "<script>alert('Error in retrieving data. Try again later'); window.location='http://localhost/lmdb/lmdb.php';</script>";

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
