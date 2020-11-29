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
        <form class="d-flex" action="search.php">
          <input class="form-control mr-2" name="search" type="search" placeholder="Search" aria-label="Search">
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

  $id = $_GET['id'];
  $image = 'image'.$id.'.jpg';
  $path = "static/series/$image";

  $flag = 0;

  // connect to the database
  $connection = mysqli_connect('localhost', 'root', '', 'lmdb');
  $query = "SELECT * FROM series WHERE id = '$id'";
  $res = mysqli_query($connection, $query);

  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
    $genre = $row['genre'];
    $rating = $row['rating'];
    $year = $row['year'];
    $duration = $row['duration'];
    $seasons = $row['seasons'];
    $episodes = $row['episodes'];
    $plot = $row['plot'];
    $cast = $row['cast'];

    $actors = explode(", ", $cast);
    if($id > 10 && $id <= 20){
      $id -= 10;
      $flag = 1;
    }
    else if($id > 20){
      $id -= 20;
      $flag = 2;
    }

    echo "<h2>$name (Rank: $id)</h2>";
    echo "<div class='container'><div class='row'>";
    echo "<div class='col-6'>";
    echo "<img src='$path' style='width:360px;height:100%;' alt='cover photo'>";
    echo "</div><div class='col-6'>";
    echo "<ul class='nav nav-tabs' id='myTab' role='tablist'>";
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link text-primary active' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Details</a>";
    echo "</li>";
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link text-primary' id='profile-tab' data-toggle='tab' href='#profile' role='tab' aria-controls='profile' aria-selected='false'>Cast n Plot</a>";
    echo "</li>";
    if(isset($_COOKIE['username'])){
      echo "<li class='nav-item' role='presentation'>";
      echo "<a class='nav-link text-primary' id='contact-tab' data-toggle='tab' href='#contact' role='tab' aria-controls='contact' aria-selected='false'>Rating & Review</a>";
      echo "</li>";
    }
    echo "<li class='nav-item' role='presentation'>";
    echo "<a class='nav-link text-primary' id='users-tab' data-toggle='tab' href='#users' role='tab' aria-controls='users' aria-selected='false'>User Ratings</a>";
    echo "</li>";
    echo "</ul>";
    echo "<div class='tab-content' id='myTabContent'>";
    echo "<div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>";
    echo "<br>Genres: $genre<br>";
    echo "Rating: $rating<br>";
    echo "Release: $year<br>";
    echo "Seasons: $seasons<br>";
    echo "Episodes: $episodes<br>";
    echo "Avg. Duration: $duration minutes</div><br>";
    echo "<div class='tab-pane fade' id='profile' role='tabpanel' aria-labelledby='profile-tab'>";
    echo "Cast:<br>";
    for($i = 0; $i < count($actors); $i++){
      $actor = explode(" /", $actors[$i]);
      echo $actor[0];
      if(count($actor) > 1)
        echo ")";
      echo "<br>";
    }
    echo "<br>";
    echo "Plot:<br>$plot</div>";

    if($flag == 1)
      $id += 10;
    else if($flag == 2)
      $id += 20;

      if(isset($_COOKIE['username'])){
        echo "<div class='tab-pane fade' id='contact' role='tabpanel' aria-labelledby='contact-tab'>";
        $username = $_COOKIE['username'];
        $rating = "";
        $review = "";
        $query = "SELECT * FROM sreviews WHERE sid = '$id' AND username = '$username' ORDER BY time DESC";
        $res = mysqli_query($connection, $query);
        if(mysqli_num_rows($res) > 0){
          $row = mysqli_fetch_assoc($res);
          $rating = $row['rating'];
          $review = $row['review'];
        }
        echo "<form action='sreview.php' method='POST'>";
        echo "<div class='mb-3'>";
        echo "<label for='rating' class='form-label'>Rating</label><br>";
        echo "<input class='form-control' type='number' name='rating' min='1' max='10' value='$rating'></div>";
        echo "<div class='mb-3'>";
        echo "<label for='review' class='form-label'>Review</label>";
        echo "<textarea class='form-control' name='review' rows='3'>$review</textarea></div>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<button type='submit' class='btn btn-primary'>Submit</button></form>";
        echo "</div>";
      }
    echo "<div class='tab-pane fade' id='users' role='tabpanel' aria-labelledby='users-tab'>";
    $query = "SELECT * FROM sreviews WHERE sid = '$id'";
    $res = mysqli_query($connection, $query);

    if(mysqli_num_rows($res) > 0){
      echo "<div class='container'>";
      for($i = 0; $i < mysqli_num_rows($res); $i++){
        $row = mysqli_fetch_assoc($res);
        $user = $row['username'];
        $review = $row['review'];
        $rating = $row['rating'];
        echo "<div class='row'>";
        echo "<h5>$user (Rating: $rating)</h5>";
        echo "<p>$review</p>";
        echo "</div>";
      }
      echo "</div>";
    }
    else{
      echo "<h4>No ratings and reviews by any user</h4>";
    }
    echo "</div></div>";
    echo "</div></div></div><br>";
  }
  else
    echo "<script>alert('Select some series'); window.location = 'http://localhost/lmdb/lmdb.php';</script>";

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>

</body>
</html>
