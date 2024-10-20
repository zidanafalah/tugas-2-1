<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $look = $_POST["search"];

  $sql = "SELECT `id`, `location`, `image`, `price` FROM `parking_spot` WHERE `location` LIKE '%$look%'";
  $result = mysqli_query($con, $sql);

  $searchResults = array();

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $location = $row['location'];
      $image = $row['image'];
      $price = $row['price'];

      $searchResult = array(
        'id' => $id,
        'location' => $location,
        'image' => $image,
        'price' => $price
      );

      array_push($searchResults, $searchResult);
    }
  }

  header("Content-Type: application/json");
  echo json_encode($searchResults);
}
?>