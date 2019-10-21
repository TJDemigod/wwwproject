<?php 
include('server.php');
include('header.php');
$gotomovie = $_GET['gotomovie'];
$showmovie = "SELECT movieID, title, shortDescription, fullDescription, category, yearOfWork, link, movieImage, movieLength  FROM movies WHERE movieID = '$gotomovie'";
mysqli_query($db, $showmovie);
$result = $db->query($showmovie);
while($row = $result->fetch_assoc()) {
  $movieID = $row["movieID"];
  $title = $row["title"];
  $shortDesc = $row["shortDescription"];
  $fullDesc = $row["fullDescription"];
  $category = $row["category"];
  $releaseyear = $row["yearOfWork"];
  $movielink = $row["link"];
  $imglink = $row["movieImage"];
  $runtime = $row["movieLength"];
  }

  if (isset($_POST['edit_movie'])){
    $releaseyear = $_POST['yearOfWork'];
    $shortDesc = $_POST['shortDescription'];
    $fullDesc = $_POST['fullDescription'];
    $category = $_POST['category'];
    $releaseyear = $_POST['yearOfWork'];
    $movielink = $_POST['link'];
    $imglink = $_POST['movieImage'];
    $runtime = $_POST['movieLength'];
    $updatemovie = "UPDATE movies SET yearOfWork = '$releaseyear', shortDescription = '$shortDesc', fullDescription = '$fullDesc', category = '$category', link = '$movielink', movieLength = '$runtime', movieImage = '$imglink'  WHERE movieID = $movieID"; 
    mysqli_query($db, $updatemovie);
    header ("location: showmovie.php?gotomovie=$movieID");
  }
?>


<form method="post" action="" class="addMovie">
<?php include('errors.php'); ?>
    <div><label><?php echo $title; ?></label></div>
    <div><label>Short Description</label></div>
    <div>
    <input type="text" name="shortDescription" value="<?php echo $shortDesc; ?>">
    </div>
    <div><label> Full Description</label></div>
    <div>
    <input type="text" name="fullDescription" value="<?php echo $fullDesc; ?>">
    </div>
    <div><label>Category</label></div>
    <div>
    <select name="category">
  <option value="Action">Action</option>
  <option value="Adventure">Adventure</option>
  <option value="Comedy">Comedy</option>
  <option value="Crime">Crime</option>
  <option value="Drama">Drama</option>
  <option value="Horror">Horror</option>
  <option value="Romance">Romance</option>
  <option value="Science Fiction">Science Fiction</option>
  <option value="Thriller">Thriller</option>
</select> 
    </div>
    <div><label>Release Year</label></div>
    <div>
    <input type="text" name="yearOfWork" value="<?php echo $releaseyear; ?>">
    <div>
    <div><label>Movie Length</label></div>
    <div>
    <input type="text" name="movieLength" value="<?php echo $runtime; ?>">
    </div>
    <div><label>Link</label></div>
    <div>
    <input type="text" name="link" value="<?php echo $movielink; ?>">
    </div>
    <div><label>Movie Image</label></div>
    <div>
    <input type="text" name="movieImage" value="<?php echo $imglink; ?>">
    </div>
    <div class="input-group">
    <button type="submit" class="btn" name="edit_movie">Edit movie info</button>
  	</div>
  </form>
