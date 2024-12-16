<?php
 include "confige.php";
$sql = "SELECT id, player_name, photo,  rating FROM player";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["player_name"]. " " . $row["rating"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
