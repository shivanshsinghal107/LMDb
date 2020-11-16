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
      padding: 20px;
    }

    img{
      margin-left: 130px;
    }

    #myTab, #myTabContent{
      margin-left: -130px;
    }

    #myTab a{
      color: #fff;
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

    echo "<h2>$name (Rank: $id)</h2>";
    echo "<div class='container'><div class='row'>";
    echo "<div class='col-6'>";
    echo "<img src='$path' style='width:360px;height:100%;' alt='cover photo'>";
    echo "</div><div class='col-6'>";
    echo "<ul class='nav nav-tabs' id='myTab' role='tablist'>";
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link active' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Details</a>";
    echo "</li>";
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link' id='profile-tab' data-toggle='tab' href='#profile' role='tab' aria-controls='profile' aria-selected='false'>Cast n Plot</a>";
    echo "</li>";
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link' id='contact-tab' data-toggle='tab' href='#contact' role='tab' aria-controls='contact' aria-selected='false'>Rating & Review</a>";
    echo "</li>";
    echo "</ul>";
    echo "<div class='tab-content' id='myTabContent'>";
    echo "<div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>";
    echo "<br>Genres: $genre<br>";
    echo "Rating: $rating<br>";
    echo "Release: $year<br>";
    echo "Duration: $duration minutes</div><br>";
    echo "<div class='tab-pane fade' id='profile' role='tabpanel' aria-labelledby='profile-tab'>";
    echo "Cast:<br>";
    for($i = 0; $i < count($actors); $i++){
      $actor = explode("/", $actors[$i]);
      echo $actor[0];
      if(count($actor) > 1)
        echo ")";
      echo "<br>";
    }
    echo "<br>";
    echo "Plot:<br>$plot</div>";
    echo "<div class='tab-pane fade' id='contact' role='tabpanel' aria-labelledby='contact-tab'>";

    if($flag)
      $id += 10;

    if(isset($_COOKIE['username'])){
      echo "<form action='mreview.php' method='POST'>";
      echo "<div class='mb-3'>";
      echo "<label for='rating' class='form-label'>Rating</label>";
      echo "<input class='form-control' type='number' name='rating' min='1' max='10'></div>";
      echo "<div class='mb-3'>";
      echo "<label for='review' class='form-label'>Review</label>";
      echo "<textarea class='form-control' name='review' rows='3'></textarea></div>";
      echo "<input type='hidden' name='id' value='$id'>";
      echo "<button type='submit' class='btn btn-primary'>Submit</button></form>";
    }
    echo "</div></div>";
    echo "</div></div></div><br>";
  }
  else
    echo "<script>alert('Select some movie'); window.location = 'http://localhost/lmdb/lmdb.php';</script>";

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
