<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="TJMV.css">

<!--Search box JS-->    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
  $(document).ready(function(){
      $(".input").focus(function(){
          $(".close-btn").addClass("active");
      });
    
      $(".input").focusout(function() {
      $(".close-btn").removeClass("active");
      $(this).val("");      
      });
  });       
</script>
    
<title>TJMV Movie Database</title>    
</head>

<body>

<!--Nav bar-->    
<header>
  <?php
  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    //$username = strtolower($username);
    if($username == 'Gus'|| $username == 'Trav') {
     echo
       '<p> Welcome, '. $_SESSION['username']. '   
       <div class="container">
       <h1 class="h1">TJMV Movie Database</h1>
       <nav>
           <ul>
               <li><a href="TJMV.php">Home</a></li>
               <li><a href="recentmovies.php">Recently Added Titles</a></li>
               <li><a href="addmovie.php">Add New Movie</a></li>
               <li><a href="addartist.php">Add New Artist</a></li>
               <li><a href="logout.php">logout</a></li>
           </ul>
       </nav>
</div>';
}
else {
   echo
       '<p> Welcome, '. $_SESSION['username']. '   
       <div class="container">
       <h1 class="h1">TJMV Movie Database</h1>
       <nav>
           <ul>
               <li><a href="TJMV.php">Home</a></li>
               <li><a href="recentmovies.php">Recently Added Titles</a></li>
               <li><a href="logout.php">logout</a></li>
           </ul>
       </nav>
</div>';
}    
}
else{
  echo '<div class="container">
       <h1 class="h1">TJMV Movie Database</h1>
       <nav>
           <ul>
               <li><a href="TJMV.php">Home</a></li>
               <li><a href="recentmovies.php">Recently Added Titles</a></li>
               <li><a href="login.php">Login</a></li>
           </ul>
       </nav>
</div>';
}
?> 

</header> 
</body> 