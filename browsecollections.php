<!DOCTYPE html>
<html>
<html lang="en">
 <head>
 <title>Browse Collections</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="finalprojectstyle.css?ref=v1">
</head>
<head>
    <body>
<header>
 <nav>
<ul>
  <li><a href="homepage.php">Beanie World</a></li>  
  <li><a href="mycollection.php">My Collection</a></li> 
  <li><a href="browsecollections.php">Browse Collections</a></li> 
  <li><a href="market.php">Market</a></li> 
  <li><a href="trading.php">Trading</a></li>
</ul>
 </nav>
</header>
</head>
<body>
<ul> 
<br>
<br>     
<?php

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT collector.username, item.description, item.URL
FROM collector
INNER JOIN collection ON collector.collectorID=collection.collectorID
INNER JOIN itemtocollection ON collection.collectionID=itemtocollection.collectionID
INNER JOIN item ON itemtocollection.itemID=item.itemID";

$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

# retrieve rows in an associative array with the field as the key 
while ($row = $result->fetch_assoc()) {
    foreach ($row as $value) {
        echo $value."<br>";
    }
    echo "<hr>";
}

$result->close();
$conn->close();


?>
</ul>
</body>
</html>