<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">

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
  <?php

  $id = $_GET['id'];
  $image = 'image'.$id.'.jpg';
  $path = "static/movies/$image";

  $flag = 0;

  // connect to the database
  $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
  $query = "SELECT * FROM movies WHERE id = '$id'";
  $res = mysqli_query($connection, $query);

  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
    $genre = $row['genre'];
    $rating = $row['rating'];
    $year = $row['year'];
    $duration = $row['duration'];
    $plot = $row['plot'];
    $cast = $row['cast'];
    $budget = $row['budget'];
    //$gross = $row['worldwide_gross'];

    $actors = explode(", ", $cast);
    if($id > 10){
      $id -= 10;
      $flag = 1;
    }

    echo "<img src='$path' style='width:400px;height:100%; float:left; margin-right: 25px;' alt='cover photo'>";
    echo "<h1>$name (Rank: $id)</h1>";
    echo "<h2>Genres: $genre<br>";
    echo "Rating: $rating<br>";
    echo "Release: $year<br>";
    echo "Duration: $duration minutes<br></h2>";
    echo "<h2>Cast:</h2><h3><ul>";
    for($i = 0; $i < count($actors); $i++){
      $actor = explode("/", $actors[$i]);
      echo "<li>".$actor[0];
      if(count($actor) > 1)
        echo ")";
      echo "</li>";
    }
    echo "</ul></h3>";
    echo "<h2>Plot:</h2><h3>$plot</h3>";
    echo "<h2>Budget: $budget</h2>";

    if($flag)
      $id += 10;

    if(isset($_COOKIE['username'])){
      echo "<form action='mreview.php' method='POST'>";
      echo "Rating: <input type='number' name='rating' min='1' max='10'><br>";
      echo "Review: <input type='text' name='review'><br>";
      echo "<input type='hidden' name='id' value='$id'>";
      echo "<input type='submit'></form>";
    }
  }
  else
    echo "<script>alert('Select some movie'); window.location = 'http://localhost/lmdb/lmdb.php';</script>";

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
