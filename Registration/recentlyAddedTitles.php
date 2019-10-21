<?php
include('server.php');
include('header.php');

$query = $latestmovie;
//$result = $db->query($query);

if ($result = $db->query($query)) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $title = $row["title"].'<br />';
         $shortDesc = $row["shortDescription"];
         $fullDesc = $row["fullDescription"];
         $category = $row["category"];
         $releaseyear = $row["yearOfWork"];
         $movielink = $row["link"];
         $imglink = $row["movieImage"];
    }
} else {
    echo "0 results";
}
$db->close();

?>

<div><h1><?php echo $title; ?></h1></div>
<h3>
    Release year: <?php echo $releaseyear; ?><div>Category: <?php echo $category; ?></div>
</h3>
<h3>Synopsis:</h3>
<h4><?php echo $shortDesc; ?></h4>
<h3>Storyline:</h3>
<h4><?php echo $fullDesc; ?></h4>
</h4>
    <div><a href="<?php echo $movielink; ?>">Movie homepage</a></div>
    <div> <img src="<?php echo $imglink; ?>" alt="link to image" style="width:200px;height:300px;"></div>
