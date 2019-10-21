<?php 
include('server.php');
include('header.php');
$gotoartist = $_GET['gotoartist'];
$showartist ="SELECT artistID, firstName, lastName, nationality, yearOfBirth, yearOfDeath, bio, picture FROM artists WHERE artistID = '$gotoartist'";
mysqli_query($db, $showartist);
$result = $db->query($showartist);
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
if (isset($_POST['edit_artist'])){
    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $nationality = $_POST["nationality"];
    $yearOfBirth = $_POST["yearOfBirth"];
    $yearOfDeath = $_POST["yearOfDeath"];
    $bio = $_POST["bio"];
    $imglink = $_POST["picture"];
    $updateartist = "UPDATE artists SET firstName = '$fName', lastName = '$lName', nationality = '$nationality', yearOfBirth = '$yearOfBirth', yearOfDeath = '$yearOfDeath', bio = '$bio', picture = '$imglink'  WHERE artistID = $artistID"; 
    mysqli_query($db, $updateartist);
    header ("location: showartist.php?gotoartist=$artistID");
  }
?>
<form method="post" action="" class="addartist">
    <?php include('errors.php'); ?>
    <label>First Name</label><br>
    <input type="text" name="firstName" value="<?php echo $fName; ?>"><br>
    <label>Last Name</label><br>
    <input type="text" name="lastName" value="<?php echo $lName; ?>"><br>
    <label>Nationality</label><br>
    <input type="text" name="nationality" value="<?php echo $nationality; ?>"><br>
    <label>Year of birth</label><br>
    <input type="text" name="yearOfBirth" value="<?php echo $yearOfBirth; ?>"><br>
    <label>Year of death</label><br>
    <input type="text" name="yearOfDeath" value="<?php echo $yearOfDeath; ?>"><br>
    <label>Artist bio</label><br>
    <input type="text" name="bio" value="<?php echo $bio; ?>"><br>
    <label>Image link</label><br>
    <input type="text" name="picture" value="<?php echo $imglink; ?>"><br>
    <div class="input-group">
    <button type="submit" class="btn" name="edit_artist">Edit artist</button>
  	</div>
  </form>