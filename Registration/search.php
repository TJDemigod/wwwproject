<?php
include('server.php');
include('header.php');

$showresult = array();
$showartistresult = array();
$moviecount ="";
$artistcount ="";
$cleanSearch = $_GET['search'];
$countquery = ("SELECT COUNT(title) FROM movies WHERE title LIKE '%$cleanSearch%' OR fullDescription LIKE '%$cleanSearch%' OR shortDescription LIKE '%$cleanSearch%' OR category LIKE '%$cleanSearch%'");
$searchquery = ("SELECT * FROM movies WHERE title LIKE '%$cleanSearch%' OR shortDescription LIKE '%$cleanSearch%'OR fullDescription LIKE '%$cleanSearch%' OR category LIKE '%$cleanSearch%'");

$countartistquery = ("SELECT COUNT(firstName) FROM artists WHERE firstName LIKE '%$cleanSearch%' OR lastName LIKE '%$cleanSearch%' OR bio LIKE '%$cleanSearch%'");
$searchartistquery = ("SELECT * FROM artists WHERE firstName LIKE '%$cleanSearch%' OR lastName LIKE '%$cleanSearch%' OR bio LIKE '%$cleanSearch%'");


$countresult = mysqli_query($db, $countquery);
$row = mysqli_fetch_row($countresult);
$moviecount = $row[0];
$searchresult = mysqli_query($db, $searchquery);
$row = mysqli_fetch_row($searchresult);
//Movie search
if($moviecount == 0){
}
if($moviecount >=1){
$showresult[0][0] = $row[0]; //movieID
$showresult[0][1] = $row[1]; //movie image
$showresult[0][2] = $row[2]; //movie title
$showresult[0][4] = $row[5]; //category
$showresult[0][3] = $row[6]; //year of work
for($i = 1; $i <= $moviecount; $i++){
  $index = $i;
while($row = $searchresult->fetch_assoc()) {
    $showresult[$index][0] = $row["movieID"];
    $showresult[$index][1] = $row["movieImage"];
    $showresult[$index][2] = $row["title"];
    $showresult[$index][4]= $row["category"];
    $showresult[$index][3]= $row["yearOfWork"];
    $index++;
    }
  }
}
//Artist search
$countresult = mysqli_query($db, $countartistquery);
$row = mysqli_fetch_row($countresult);
$artistcount = $row[0];
$searchresult = mysqli_query($db, $searchartistquery);
$row = mysqli_fetch_row($searchresult);

if($artistcount == 0){
}
if($artistcount >=1){
$showartistresult[0][0] = $row[0]; //artistID
$showartistresult[0][1] = $row[1]; //artist first name
$showartistresult[0][2] = $row[2]; //artist last name
$showartistresult[0][3] = $row[3]; //artist nationality
$showartistresult[0][4] = $row[4]; //year of birth
$showartistresult[0][5] = $row[5]; //year of death
$showartistresult[0][6] = $row[7]; //artist image link
for($i = 1; $i <= $artistcount; $i++){
  $index = $i;
while($row = $searchresult->fetch_assoc()) {
    $showartistresult[$index][0] = $row["artistID"];
    $showartistresult[$index][1] = $row["firstName"];
    $showartistresult[$index][2] = $row["lastName"];
    $showartistresult[$index][3]= $row["nationality"];
    $showartistresult[$index][4]= $row["yearOfBirth"];
    $showartistresult[$index][5]= $row["yearOfDeath"];
    $showartistresult[$index][6]= $row["picture"];
    $index++;
    }
  }
}

?>
<h1 align ="center">Search results for "<?php echo $cleanSearch ?>"</h1>
<table align="left">
<th colspan="5">Movies</th>
<?php
if($moviecount == 0){
  echo "<tr>"."<td width=\"20\">"."</td>";
  echo "<td width=\"600\">"."<br>"."\tNo search results found in movies for \"".$cleanSearch."\""."</td>"."</tr>";}
for($i = 0; $i < $moviecount; $i++)
{
  echo "<tr>";
  echo "<td width=\"10\">"."</td>";
  echo "<td width=\"150\">"."<img src=\"".$showresult[$i][1]." alt=\"link to image\" style=\"width:100px;height:150px;\""."</td>";
  echo "<td width=\"200\">"."<a href=\"showmovie.php?gotomovie=".$showresult[$i][0]."\"".">".$showresult[$i][2]."</a>"."</td>";
  echo "<td width=\"50\">".$showresult[$i][3],"</td>";
  echo "<td width=\"100\">".$showresult[$i][4],"</td>";
  echo "</tr>";
}
?>
</table>
<table align="right">

<th colspan= "5">Artists</th>
<?php
if($artistcount == 0){
  echo "<tr>"."<td>"."<br>"."No search results found in artists for \"".$cleanSearch."\""."</td>"."</tr>";}
for($i = 0; $i < $artistcount; $i++)
{
  echo "<tr>";
  echo "<td width=\"150\">"."<img src=\"".$showartistresult[$i][6]." alt=\"link to image\" style=\"width:100px;height:150px;\""."</td>";
  echo "<td width=\"200\">"."<a href=\"showartist.php?gotoartist=".$showartistresult[$i][0]."\"".">".$showartistresult[$i][1]." ".$showartistresult[$i][2]."</a>"."</td>";
  echo "<td width=\"100\">".$showartistresult[$i][3],"</td>";
  echo "<td width=\"100\">"."Born: ".$showartistresult[$i][4];
  if ($showartistresult[$i][5] > 0){
    echo "<br>"."Died: ".$showartistresult[$i][5];
  }
  echo "</td>";
  echo "</tr>";
}
?>
</table>