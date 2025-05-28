<?php
require 'connect.php';

$sql = "SELECT * FROM bags";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Bags</title>
  <style>
    table {
      border-collapse: collapse;
      width: 90%;
      margin: 20px auto;
    }
    th, td {
      border: 1px solid #aaa;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #eee;
    }
    img {
      max-width: 100px;
      height: auto;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Bags Table</h2>

  <?php
  if ($result->num_rows > 0) {
    echo "<table>
            <tr>
              <th>ID</th>
              <th>Condition</th>
              <th>Price $</th>
              <th>Name</th>
              <th>Category</th>

              <th>Image</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['condition']}</td>
              <td>{$row['price']}</td>
              <td>{$row['name']}</td>
              <td>{$row['category']}</td>
              <td><img src='{$row['imgs']}' alt='{$row['name']}'></td>
            </tr>";
    }
    echo "</table>";
  } else {
    echo "<p style='text-align:center;'>No bags found.</p>";
  }

  $conn->close();
  ?>
</body>
</html>
