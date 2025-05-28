<?php
require 'connect.php';

// Get the search query from URL, if any
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($searchQuery !== '') {
    $stmt = $conn->prepare("SELECT * FROM bags WHERE name LIKE CONCAT('%', ?, '%')");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null; // no search term, so no results
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Dancing+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500&display=swap" rel="stylesheet">

<link rel="stylesheet" href="balux.css">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Balux</title>



</head>

<body>

<div id="homeheading">
  <h1>Balux</h1>
</div>

<!-- Navigation bar with shopping cart -->
<nav>
  <div class="nav-wrapper">
    <ul>
      <li><a href="/BaluxWeb/balux.php">Home</a></li>
      <li><a href="shopall.php">Shop all</a></li>
      <li><a href="bags.php">Bags</a></li>
      <li><a href="shoes.php">Shoes</a></li>
    </ul>
    <a href="cart.php" class="nav-cart" aria-label="Shopping Cart">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 
        0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 
        2-2-.9-2-2-2zM7.16 14.26l.03-.01h9.45c.75 0 
        1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 
        0 0 21 5H6.21l-.94-2H1v2h2l3.6 
        7.59-1.35 2.44C4.52 16.37 5.48 18 
        7 18h12v-2H7l1.16-1.74z"/>
      </svg>
    </a>
    <a href="#" id="login-btn" class="nav-login" aria-label="Login">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
        <path d="M10 9a4 4 0 1 1 8 0 4 4 0 0 1-8 0zm-6 9c0-2.67 5.33-4 8-4s8 1.33 8 4v2H4v-2z"/>
      </svg>
    </a>
  </div>
</nav>

<!-- Search bar -->
<div class="center-wrapper">
  <form class="search-bar" method="get">
    <input type="text" placeholder="Search..." name="q" value="<?php echo htmlspecialchars($searchQuery); ?>" />
    
  </form>
</div>

<!-- Products listing -->
<Section class="product-gallery">
  <?php
  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         $name = htmlspecialchars($row['name']);
          $condition = htmlspecialchars($row['condition']);
          $price = htmlspecialchars($row['price']);
          $img = htmlspecialchars($row['imgs']);
          $id = htmlspecialchars($row['id']);
        $whatsappNumber = "96181680198"; 
        $message = urlencode("Hi, I'm interested in the bag: " . $row['name']);
        $whatsappLink = "https://wa.me/$whatsappNumber?text=$message";
         echo " <div class='product-card'>
              <img src='$img' alt='Image of $name'>
              <div class='product-info'>
                <h3>$name</h3>
                <p class='condition'>Condition: $condition</p>
                <p class='price'>\$$price</p>
                <a href='$whatsappLink' target='_blank'>
                  <button class='whatsapp-button'>Order on WhatsApp</button>
                </a>
              </div>
            </div>";
    }
  } else if ($searchQuery !== '') {
      echo "<p>No items found.</p>";
  }
  $conn->close();
  ?>
</Section>

<!-- Login Popup -->
<div id="login-popup" class="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closeLoginPopup()">&times;</span>
    <h2>Login</h2>
    <form id="login-form">
      <input type="text" id="username" placeholder="Username" required>
      <input type="password" id="password" placeholder="Password" required>
<button class="login-submit">Login</button>
    </form>
  </div>
</div>

<!-- Home image and intro -->
<section class="af-feature">
  <div class="af-image">
    <img src="i1.jpg" alt="Gucci" />
  </div>
  <div class="af-text">
    <h2>Welcome to our world of <br><em>timeless fancies!</em></h2>
    <p>
      Discover the beauty of timeless fashion with Aging Fancies. We are
      dedicated to sourcing the loveliest vintage designer items. Committed to
      sustainability and eco-friendliness, Aging Fancies breathes new life into
      vintage garments, ensuring each piece has a story to tell. Every item is
      100% authentic, waiting for its next caretaker—you—to appreciate its rich
      history and express your individuality.
    </p>
 
    <a href="https://www.instagram.com/chic_consignment.lb/ " class="my-button" target="_blank">Discover More!</a>
  </div>
</section>
<!--footer-->
<footer class="balux-footer">
  <div class="footer-container">
    <div class="footer-column">
      <h4>Customer Care</h4>
      <ul>
<li><a href="https://wa.me/96181680198" target="_blank">Contact</a></li>
<li><a href="#" onclick="openShippingPopup(event)">Shipping & Returns</a></li>
        <!-- Popup container -->
<div id="shipping-popup" class="popup-overlay">
  <div class="popup-content">
    <button class="close-btn" onclick="closeShippingPopup()">&times;</button>
    <h2>Shipping & Returns</h2>
    <p>
      <h3>Shipping:</h3>
      We are based in lebanon. We offer a local delivery and also world wide shipping.
      <h3>Return Policy:</h3>
      locally, customers are allowed to check and return but for overseas clients,
      returns are not acceptable as we ensure to have all the details.
      <h3>Payments and Charges:</h3>
      For customers that are based in lebanon ,they can pay COD or through whish money.
      For overseas customers , prior payments are acceptable through westernUnion.   
    </p>
  </div>
</div>
<li><a href="#" onclick="openFaqPopup(event)">FAQ</a></li>

<div id="faq-popup" class="popup-overlay">
  <div class="popup-content">
    <button class="close-btn" onclick="closeFaqPopup()">&times;</button>
    <h2>FAQ:</h2>
    <p>
      <h3>How do we authenticate our items?</h3>
      We've been in this feild for more than 5 years, so we have a great experience and knowledge
      when it comes to authenticating. Moreover,we have took courses in authenticating highbrands.
      Any item you see on the page or the website is authenticated physically and through AI.
      We use Legit Grails to authenticate specific models of bags and mainly vintage.
      Also,we use entrupy for Chanel & Hermes.
      <h3>How do we guarantee authenticity?</h3>
      All our items are supported with authenticity document that include our addressing details.
      Moreover,it includes an important line that states the following:
      "Incase, the document is falsely proved then we are responsible to refund you."
      <h3>Do u consign?</h3>
      Yes we do, we source special items and we consign specific items.
    </p>
  </div>
</div>
        
      </ul>
    </div>
   
    <div class="footer-branding">
      <h2>Balux</h2>
      <p>Curated vintage treasures for the modern romantic.</p>
     
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Balux. All rights reserved.</p>
  </div>
</footer>
<script>
// Show login popup when login icon clicked
document.getElementById('login-btn').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('login-popup').classList.add('active');
});

// Close popup on close button click
document.querySelector('#login-popup .close-btn').addEventListener('click', function() {
  document.getElementById('login-popup').classList.remove('active');
});

// Close popup when clicking outside popup-content
document.getElementById('login-popup').addEventListener('click', function(e) {
  if (e.target === this) {
    this.classList.remove('active');
  }
});
</script>

<script src="balux.js"></script>




</body>

</html>
