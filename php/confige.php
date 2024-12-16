<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "FUT";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, player_name, rating FROM player";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["player_name"]. " " . $row["rating"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>