<?php
require 'connect.php';

$sql = "SELECT * FROM bags WHERE category='shoes'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop All Bags</title>
  <link rel="stylesheet" href="balux.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="product-gallery">
    <h1 class="section-title">Shop Shoes</h1>
    <div class="product-grid">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $name = htmlspecialchars($row['name']);
          $condition = htmlspecialchars($row['condition']);
          $price = htmlspecialchars($row['price']);
          $img = htmlspecialchars($row['imgs']);
          $id = htmlspecialchars($row['id']);

          $whatsappNumber = "96181680198";
          $message = "Hi! I'm interested in this bag: $name. Condition: $condition. Price: $$price. ID:$id";
          $encodedMessage = urlencode($message);
          $whatsappLink = "https://wa.me/$whatsappNumber?text=$encodedMessage";

          echo "
            <div class='product-card'>
              <img src='$img' alt='Image of $name'>
              <div class='product-info'>
                <h3>$name</h3>
                <p class='condition'>Condition: $condition</p>
                <p class='price'>\$$price</p>
                <a href='$whatsappLink' target='_blank'>
                  <button class='whatsapp-button'>Order on WhatsApp</button>
                </a>
              </div>
            </div>
          ";
        }
      } else {
        echo "<p>No bags found.</p>";
      }

      $conn->close();
      ?>
    </div>
  </section>

</body>
</html>
