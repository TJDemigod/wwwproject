<?php
include('server.php');
include('header.php');

$gotomovie = $_GET['gotomovie'];
$showmovie = "SELECT movieID, title, shortDescription, fullDescription, category, yearOfWork, movieLength, link, movieImage FROM movies WHERE movieID = '$gotomovie'";
if (empty($gotomovie)) {
mysqli_query($db, $latestmovie);
$result = $db->query($latestmovie);
}
else{
     mysqli_query($db, $showmovie);
     $result = $db->query($showmovie);
    }
    // output data of each row
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
if (isset($_POST['delete_movie']) || !empty($_POST['delete_movie'])){
    $deletemovie ="DELETE FROM movies WHERE movieID ='$movieID'";
    mysqli_query($db, $deletemovie);
    header ("location: TJMV.php");
}

if (isset($_POST['edit_movie'])){
    header ("location: editmovie.php?gotomovie=$movieID");
}
?>
<div class="showmovie">
<h1><?php echo $title; ?></h1>
<h3>
    Release year: <?php echo $releaseyear.'<br>'; ?> Category: <?php echo $category.'<br>'; ?> Runtime: <?php echo $runtime.' mins'.'<br>'; ?>
</h3>
<h3>Synopsis:</h3>
<p class="showmovie"><?php echo $shortDesc; ?></p>
<h3>Storyline:</h3>
<p class="showmovie"><?php echo $fullDesc; ?></p>
</h4>
    <div><a href="<?php echo $movielink; ?>">Movie homepage</a></div>
    <div> <img src="<?php echo $imglink; ?>" alt="link to image" style="width:200px;height:300px;"></div>
 <?php
 /*Edit Button*/
if(isset($_SESSION['username'])) {
    if($username == 'Gus'|| $username == 'Trav') {
     echo '<form name="edit movie" method="post" action=""> 
<button type="submit" class="btn" name="edit_movie">Edit movie</button>
</form>';}}

/*Delete Button*/
 if(isset($_SESSION['username'])) {
    if($username == 'Gus'|| $username == 'Trav'){
     echo '<form name="delete movie" method="post" action=""> 
<button type="submit" class="deletebtn" name="delete_movie">Delete movie</button>
</form>';}}

?>
</div>