<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();
$search = "";
$index = "";
$search ="";
$gotomovie = ""; //Variable used to load movies in "showmovie.php" based on movieID

// db movie variables
$movieID = $title = $movieImage = $fullDescription = $shortDescription = $link = $movieLength = $yearOfWork = $category = "";

//database artist variables
$artistID = $fName = $lName = $nationality = $yearOfBirth = $yearOfDeath = $bio = $imglink = $gotoartist = ""; 


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'moviegallery');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

// stored Mysql queries
$latestmovie = "SELECT movieID, title, shortDescription, fullDescription, category, yearOfWork, movieLength, link, movieImage FROM movies WHERE movieID = (SELECT MAX(movieID) FROM movies)";
$showmovie = "SELECT title, shortDescription, fullDescription, category, yearOfWork, movieLength, link, movieImage FROM movies WHERE * LIKE '%$search%'";

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admins WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO admins (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: TJMV.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//SEARCH
if (isset($_POST['search'])){
  $cleanSearch = mysqli_real_escape_string($_POST['search']);
  header ("location: search.php?search=$cleanSearch");
}

//ADD NEW ARTIST
if (isset($_POST['add_artist'])){
  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
  $nationality = mysqli_real_escape_string($db, $_POST['nationality']);
  $yearOfBirth = mysqli_real_escape_string($db, $_POST['yearOfBirth']);
  $yearOfDeath = mysqli_real_escape_string($db, $_POST['yearOfDeath']);
  $bio = mysqli_real_escape_string($db, $_POST['bio']);
  $picture = mysqli_real_escape_string($db, $_POST['picture']);

  //Form validation
  if (empty($firstName)) { array_push($errors, "First Name required");}
  if (empty($lastName)) { array_push($errors, "Last Name required");}
  if(empty($yearOfBirth)) { array_push($errors, "Please enter the year of birth.");}
  if(empty($yearOfDeath)){$yearOfDeath = 0;}
  else if(!is_numeric($yearOfBirth)) { array_push($errors, "Please enter a valid year");}
  else if(strlen($yearOfBirth) != 4) { array_push($errors, "Please enter a valid year");}

  // first check the database to make sure 
  // an artist does not already exist with the same firstname and lastname 
  $artist_check_query = "SELECT * FROM artists WHERE firstName='$firstName' AND lastName='$lastName' LIMIT 1";
  $result = mysqli_query($db, $artist_check_query);
  $artist = mysqli_fetch_assoc($result);

   // if user exists
    if ($artist['firstName'] === $firstName && $artist['lastName'] === $lastName) {
      array_push($errors, "Artist already exists");
    }
  

  if (count($errors) == 0){
    $newartist = "INSERT INTO artists (firstName, lastName, nationality, yearOfBirth, yearOfDeath, bio, picture) VALUES ('$firstName', '$lastName', '$nationality', '$yearOfBirth', '$yearOfDeath', '$bio', '$picture')";
    if ($db->query($newartist) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}
  header ("location: showartist.php?gotoartist=");
}
}

// ADD NEW MOVIE
if (isset($_POST['add_movie'])){
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $fullDescription = mysqli_real_escape_string($db, $_POST['fullDescription']);
  $shortDescription = mysqli_real_escape_string($db, $_POST['shortDescription']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $yearOfWork = mysqli_real_escape_string($db, $_POST['yearOfWork']);
  $movieLength = mysqli_real_escape_string($db, $_POST['movieLength']);
  $movieImage = mysqli_real_escape_string($db, $_POST['movieImage']);
  $link = mysqli_real_escape_string($db, $_POST['link']);

//Form validation & errors
if (empty($title)) { array_push($errors, "Movie title is required");}
if (empty($shortDescription)) { array_push($errors, "Short description required"); } 
if (empty($fullDescription)) {$fullDescription = $shortDescription;}
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) { array_push($errors, "Invalid link");}
if(empty($yearOfWork)) { array_push($errors, "Please enter a release year.");}
else if(!is_numeric($yearOfWork)) { array_push($errors, "Please enter a valid year");}
else if(strlen($yearOfWork) != 4) { array_push($errors, "Please enter a valid year");}

// first check the database to make sure 
  // a movie does not already exist with the same title and/or link
  $movie_check_query = "SELECT * FROM movies WHERE title='$title' OR link='$link' LIMIT 1";
  $result = mysqli_query($db, $movie_check_query);
  $movie = mysqli_fetch_assoc($result);
  
  if ($movie) { // if user exists
    if ($movie['title'] === $title) {
      array_push($errors, "Title already exists");
    }

    if ($movie['link'] === $link) {
      array_push($errors, "Link already exists");
    }
  }

// Error check before adding to DB
if (count($errors) == 0){
  $query = "INSERT INTO movies (movieImage, title, fullDescription, shortDescription, category, yearOfWork, movieLength, link) VALUES ('$movieImage', '$title', '$fullDescription', '$shortDescription', '$category', '$yearOfWork', '$movieLength', '$link')";
  if ($db->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}
  header ("location: showmovie.php?gotomovie=");
mysqli_query($db, $newmovie);}
//SQL query to select the latest movie in the db

}
?>