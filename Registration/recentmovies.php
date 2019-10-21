<?php 
include('server.php');
include('header.php');
$movie = array();

$index = 0;
for ($i = 0; $i < 5; $i++){
  $checkid = "SELECT COUNT(movieID) FROM movies WHERE movieID = (SELECT MAX(movieID)-$index FROM movies)";
  $result = mysqli_query($db, $checkid);
  $row = mysqli_fetch_row($result);
  $check = $row[0];
  while ($check == 0){
  $index++;
  $checkid = "SELECT COUNT(movieID) FROM movies WHERE movieID = (SELECT MAX(movieID)-$index FROM movies)";
  $result = mysqli_query($db, $checkid);
  $row = mysqli_fetch_row($result);
  $check = $row[0];
  }
  $listmovies = "SELECT movieID, title, shortDescription, fullDescription, category, yearOfWork, link, movieImage FROM movies WHERE movieID = ((SELECT MAX(movieID)FROM movies)-'$index')";
  $index = $index+1;
  mysqli_query($db, $listmovies);
  $result = $db->query($listmovies);
while($row = $result->fetch_assoc()) {
     $movie[$i][0] = $row["movieID"];
     $movie[$i][1] = $row["movieImage"];
     $movie[$i][2] = $row["title"];
     $movie[$i][3] = $row["yearOfWork"];
     $movie[$i][4] = $row["category"];
    }

}
?>
<table style="width:70%">
<table align="center">
<?php
for($i =0; $i < 5; $i++)
{
  echo "<tr>";
  echo "<td width=\"150\">"."<img src=\"".$movie[$i][1]." alt=\"link to image\" style=\"width:100px;height:150px;\""."</td>";
  echo "<td width=\"300\">"."<a href=\"showmovie.php?gotomovie=".$movie[$i][0]."\"".">".$movie[$i][2]."</a>"."</td>";
  echo "<td width=\"100\">".$movie[$i][3],"</td>";
  echo "<td width=\"100\">".$movie[$i][4],"</td>";
  echo "</tr>";
}
?>
</table>