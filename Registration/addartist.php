<?php include('server.php');
include('header.php');
?>

<form method="post" action="" class="addartist">
<?php include('errors.php'); ?>
    <div><label>First Name</label></div>
    <div>
    <input type="text" name="firstName" value="">
    </div>
    <div><label>Last Name</label></div>
    <div>
    <input type="text" name="lastName" value="">
    </div>
    <div><label>Year of birth</label></div>
    <div>
    <input type="text" name="yearOfBirth" value="">
    </div>
    <div><label>Year of death</label></div>
    <div>
    <input type="text" name="yearOfDeath" value="">
    </div>
    <div><label>Nationality</label></div>
    <div>
    <input type="text" name="nationality" value="">
    </div>
    <div><label>Bio</label></div>
    <div>
    <textarea rows="10" cols="30" name="bio" value=""></textarea>
    </div>
    <div><label>Picture</label></div>
    <div>
    <input type="text" name="picture" value="">
    </div>
    <div class="input-group">
    <button type="submit" class="btn" name="add_artist">Add artist</button>
  	</div>
</form>