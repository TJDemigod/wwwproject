<?php
include('server.php');
include('header.php');

$gotoartist = $_GET['gotoartist'];
$showartist ="SELECT artistID, firstName, lastName, nationality, yearOfBirth, yearOfDeath, bio, picture FROM artists WHERE artistID = '$gotoartist'";
$latestartist ="SELECT artistID, firstName, lastName, nationality, yearOfBirth, yearOfDeath, bio, picture FROM artists WHERE artistID = (SELECT MAX(artistID) FROM artists)";


if (empty($gotoartist)) {
mysqli_query($db, $latestartist);
$result = $db->query($latestartist);
}
else{
    mysqli_query($db, $showartist);
$result = $db->query($showartist);
}

while($row = $result->fetch_assoc()) {
    $artistID = $row["artistID"];
    $fName = $row["firstName"];
    $lName = $row["lastName"];
    $nationality = $row["nationality"];
    $yearOfBirth = $row["yearOfBirth"];
    $yearOfDeath = $row["yearOfDeath"];
    $bio = $row["bio"];
    $imglink = $row["picture"];
}
if (isset($_POST['delete_artist']) || !empty($_POST['delete_artist'])){
    $deleteartist ="DELETE FROM artists WHERE artistID ='$artistID'";
    mysqli_query($db, $deleteartist);
    header ("location: TJMV.php");
}
if (isset($_POST['edit_artist'])){
    header ("location: editartist.php?gotoartist=$artistID");
}
?>
<div class="showmovie">
<h1><?php echo $fName; ?> <?php echo $lName; ?></h1>
<h3>
    Born: <?php echo $yearOfBirth; ?>
    <?php if($yearOfDeath >0){echo "Died: ".$yearOfDeath;}?>
    <div><?php echo $nationality; ?></div>
</h3>
<h3>Bio:</h3>
<h4><?php echo $bio; ?></h4>
</h4>
    <div> <img src="<?php echo $imglink; ?>" alt="link to image" style="width:200px;height:300px;"></div>

<?php
 /*Edit Button*/
if(isset($_SESSION['username'])) {
    if($username == 'Gus'|| $username == 'Trav') {
     echo '<form name="edit artist" method="post" action=""> 
<button type="submit" class="btn" name="edit_artist">Edit artist</button>
</form>';}}

/*Delete Button*/
 if(isset($_SESSION['username'])) {
    if($username == 'Gus'|| $username == 'Trav'){
     echo '<form name="delete artist" method="post" action=""> 
<button type="submit" class="btn" name="delete_artist">Delete artist</button>
</form>';}}

?>
</div>