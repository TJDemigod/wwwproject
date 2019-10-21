<?php 
include('server.php');
include('header.php');
?>


<form method="post" action="addmovie.php" class="addMovie">
<?php include('errors.php'); ?>
    <div><label>Title</label></div>
    <div>
    <input type="text" name="title" value="">
    </div>
    <div><label>Short Description</label></div>
    <div>
    <input type="text" name="shortDescription" placeholder="Max Chars 250">
    </div>
    <div><label> Full Description</label></div>
    <div>
    <textarea rows="10" cols="30" name="fullDescription" value=""></textarea>
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
    <input type="int" name="yearOfWork" value="">
    <div>
    <div><label>Movie Length</label></div>
    <div>
    <input type="int" name="movieLength" placeholder="Runtime in mins">
    </div>
    <div><label>Link</label></div>
    <div>
    <input type="text" name="link" placeholder="Link to movie website">
    </div>
    <div><label>Movie Image</label></div>
    <div>
    <input type="text" name="movieImage" placeholder="Link to movie poster">
    </div>
    <div class="input-group">
    <button type="submit" class="btn" name="add_movie">Add movie</button>
  	</div>
  </form>

