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
<head>
  <style>
  body {
  margin: 0;
  padding: 0;
  font-family: 'Georgia', serif;
  background-color: #fff8f5;
  color: #2f2f2f;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  min-height: 100vh;
  padding: 40px 20px;
  box-sizing: border-box;
}



/* Main heading */
h1 {
  font-size: 2.5rem;
  margin: 20px 0 10px;
}

/* Subheading */
h2 {
  font-size: 1.5rem;
  margin-bottom: 20px;
  font-weight: normal;
}

/* Paragraph styling */
p {
  font-size: 1.1rem;
  max-width: 600px;
  line-height: 1.6;
}

/* WhatsApp link */
p a {
  color: #25d366;
  text-decoration: none;
  font-weight: bold;
}

p a:hover {
  text-decoration: underline;
}
  </style>
    <link rel="stylesheet" href="balux.css">

</head>
<body>
  <div id="homeheading">
  <h1>Balux</h1>
</div>
  <h1>Coming Soon</h1>
  <h2>Welcome to Balux & Enjoy Shopping</h2>
  <p>Our Cart is still under construction.
    Please Place your orders through whatsapp.<a href="https://wa.me/96181680198" target="_blank">contact</a>
    
  </p>
</body>
</html>