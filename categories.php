<?php
session_start();
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "efm";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Add product to cart via session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
  $product_id = intval($_POST['add_to_cart']);

  // Initialize the cart array if not already
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  // If product already in cart, increment quantity; else, add it with quantity 1
  if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += 1;
  } else {
    $_SESSION['cart'][$product_id] = [
      'quantity' => 1
    ];
  }

  $redirect_category = $_GET['category_id'] ?? 'all';
  header("Location: categories.php?category_id=" . urlencode($redirect_category) . "&product_id=" . $product_id);
}

// Fetch Categories for the dropdown
$categories_sql = "SELECT id_Categories, libelle_Categories FROM categories ORDER BY libelle_Categories ASC";
$categories_result = $conn->query($categories_sql);
$categories = [];
if ($categories_result && $categories_result->num_rows > 0) {
  while ($cat_row = $categories_result->fetch_assoc()) {
    $categories[] = $cat_row;
  }
}

// --- Product Fetching ---
$selected_category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 'all';

$sql = "SELECT p.id_Produit, p.product_name, p.prix_de_vente, p.image
        FROM produit p ";

if ($selected_category_id !== 'all' && is_numeric($selected_category_id)) {
  $sql .= " WHERE p.id_Categories = ?";
}

$sql .= " ORDER BY p.id_Produit ASC";

$stmt = $conn->prepare($sql);

if ($selected_category_id !== 'all' && is_numeric($selected_category_id)) {
  $stmt->bind_param("i", $selected_category_id);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Categories</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/categories.css"> <!-- Make sure this CSS file exists and is styled correctly -->
</head>

<body>
  <!-- Header Section Start -->
  <header class="site-header">
    <div class="top-bar">
      <p>FREE SHIPPING FOR ORDERS OVER 40 €. FREE RETURNS OVER 60 DAYS.</p>
    </div>

    <div class="main-header">
      <div class="logo">
        <a href="home.php"> <!-- Consider changing to index.php if your homepage is PHP -->
          <img src="images/logo_Y.png" alt="House Electronics Logo" />
        </a>
      </div>
      <div class="header-content">
        <nav class="nav-menu">
          <ul>
            <li>
              <a href="home.php">Home <i class="fas fa-angle-down"></i></a> <!-- Consider changing to index.php -->
            </li>
            <li><a href="about.php">About</a></li> <!-- Create or link to about.php if needed -->
            <li>
              <a href="categories.php"
                Categories <i class="fas fa-angle-down"></i></a>
            </li>
            <li><a href="#contact">Contact</a></li> <!-- Create or link to contact.php if needed -->
          </ul>
        </nav>

        <div class="header-actions">
          <a href="#">
            <div class="icon-circle"><i class="fas fa-search"></i></div>
          </a>
          <a href="#">
            <div class="icon-circle">
              <i class="far fa-heart"></i>
            </div>
          </a>
          <a href="shopping_cart.php">
            <div class="icon-circle">
              <i class="fas fa-shopping-bag"></i>
            </div>
          </a>
          <a href="sign_in.php" class="signin-btn">Sign-in</a> <!-- Create or link to login.php if needed -->
        </div>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <div class="categories-container">
    <div class="categories-header">
      <h2>Categories</h2>
      <p>Find your saved items and prepare to place your order.</p>
    </div>

    <div class="filters">
      <div class="filter-item dropdown">
        <select id="categoryFilter" name="category_id" onchange="filterByCategory()" style="border :none; background-color: #E9ECEF;">
          <option value="all" <?= ($selected_category_id === 'all') ? 'selected' : '' ?>>All Categories</option>
          <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
              <option value="<?= htmlspecialchars($category['id_Categories']) ?>"
                <?= ($selected_category_id == $category['id_Categories']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['libelle_Categories']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="filter-item">
        <input type="text" id="searchProduct" placeholder="Search products...">
        <i class="fas fa-search"></i>
      </div>
    </div>

    <div class="product-grid">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="product-card">
            <?php
            // Check if image data exists and is a valid URL or path
            if (!empty($row["image"])) {
              // Assuming $row["image"] might be a relative path like 'images/product.jpg'
              // or a full URL.
              // For security and correctness, ensure it's a safe path or URL.
              // If it's a relative path from a specific directory, prepend it.
              // Example: $image_src = "uploads/products/" . htmlspecialchars($row["image"]);
              $image_src = htmlspecialchars($row["image"]); // Using direct value for now
            } else {
              $image_src = "https://via.placeholder.com/200x150.png?text=No+Image";
            }
            ?>
            <img src="<?= $image_src ?>" alt="<?= htmlspecialchars($row["product_name"]) ?>">
            <h3><?= htmlspecialchars($row["product_name"]) ?></h3>
            <p class="price"><?= htmlspecialchars(number_format((float)$row["prix_de_vente"], 2, ',', '.')) ?> DH</p> <!-- Corrected decimal separator for DH -->
            <div class="rating">
              <!-- Static stars for now, can be dynamic if rating is in DB -->
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i> <!-- Example of half star -->
            </div>
            <form method="post" action="categories.php?category_id=<?= htmlspecialchars($selected_category_id) ?>">
              <input type="hidden" name="add_to_cart" value="<?= htmlspecialchars($row['id_Produit']) ?>">
              <button type="submit" class="buy-button">Buy</button>
            </form>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-products">No products found for the selected category.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Footer Section Start -->

  <footer id="contact" class="site-footer">
    <div class="footer-container">
      <div class="footer-main">
        <!-- Column 1: Get Help -->
        <div class="footer-column">
          <h4>Get Help</h4>
          <ul>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Live Chat</a></li>
            <li><a href="#">Check Order Status</a></li>
            <li><a href="#">Refunds</a></li>
            <li><a href="#">Report Abuse</a></li>
          </ul>
        </div>

        <!-- Column 2: Catégorie -->
        <div class="footer-column">
          <h4>Catégorie</h4>
          <ul>
            <li><a href="categories.php?category_id=X">Small Appliances</a></li> <!-- Link to specific categories if IDs are known -->
            <li><a href="categories.php?category_id=Y">Kitchen Appliances</a></li>
            <li><a href="categories.php?category_id=Z">Laundry Appliances</a></li>
            <li><a href="categories.php?category_id=W">Heating and Air Conditioning</a></li>
          </ul>
        </div>

        <!-- Column 3: Payments -->
        <div class="footer-column">
          <h4>Payments and Protections</h4>
          <ul>
            <li><a href="#">Secure and Easy Payments</a></li>
            <li><a href="#">Refund Policy</a></li>
            <li><a href="#">On-Time Delivery</a></li>
            <li><a href="#">After-Sales Protections</a></li>
            <li>
              <a href="#">Production Monitoring and Inspection Services</a>
            </li>
          </ul>
        </div>

        <!-- Column 4: About -->
        <div class="footer-column">
          <h4>About the Company</h4>
          <ul>
            <li><a href="about.html">Who Are We?</a></li> <!-- Link to about.php if created -->
            <li><a href="#">Social Responsibility</a></li>
          </ul>
        </div>

        <!-- Column 5: Contact -->
        <div class="footer-column">
          <h4>Contact</h4>
          <div class="contact-icons">
            <a href="https://web.whatsapp.com/"><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp" /></a>
            <a href="https://mail.google.com/"><img src="images/gmail-svgrepo-com.svg" alt="Gmail" /></a>
          </div>
        </div>

        <!-- Column 6: Follow Us -->
        <div class="footer-column">
          <h4>Follow Us</h4>
          <div class="social-icons">
            <a href="https://www.facebook.com/?locale=fr_FR" class="social-icon facebook-bg"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/" class="social-icon twitter-bg"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/feed" class="social-icon linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.instagram.com/" class="social-icon instagram-bg"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>

      <hr class="footer-divider" />

      <div class="footer-bottom">
        <p class="copyright-text">
          © <?php echo date("Y"); ?> House Electronics. All Rights Reserved <!-- Dynamic year -->
        </p>
        <div class="footer-legal-links">
          <a href="#">Terms & Conditions</a>
          <span>|</span>
          <a href="#">Privacy Policy</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->

  <script>
    function filterByCategory() {
      const categoryId = document.getElementById('categoryFilter').value;
      // Assuming the current file is categories.php or similar
      window.location.href = `?category_id=${categoryId}${window.location.hash}`; // Keep any existing hash
    }

    document.getElementById('searchProduct').addEventListener('keyup', function() {
      let searchTerm = this.value.toLowerCase();
      let productCards = document.querySelectorAll('.product-grid .product-card'); // Be more specific with selector
      let noProductsMessage = document.querySelector('.no-products');
      let foundProducts = 0;

      productCards.forEach(function(card) {
        let productName = card.querySelector('h3').textContent.toLowerCase();
        if (productName.includes(searchTerm)) {
          card.style.display = ''; // Or 'flex', 'grid' depending on your CSS
          foundProducts++;
        } else {
          card.style.display = 'none';
        }
      });

      if (noProductsMessage) {
        if (foundProducts > 0) {
          noProductsMessage.style.display = 'none';
        } else {
          // Only show 'no products match search' if there were products to begin with for the category
          if (productCards.length > 0) { // If there were cards initially (before search)
            noProductsMessage.textContent = "No products match your search.";
            noProductsMessage.style.display = 'block';
          } else { // If no products were loaded for the category initially
            noProductsMessage.textContent = "No products found for the selected category.";
            noProductsMessage.style.display = 'block';
          }
        }
      }
    });

    // To ensure the "no products" message is correctly displayed on initial load if no products
    document.addEventListener('DOMContentLoaded', function() {
      let productCards = document.querySelectorAll('.product-grid .product-card');
      let noProductsMessage = document.querySelector('.no-products');
      if (noProductsMessage && productCards.length === 0) {
        noProductsMessage.style.display = 'block';
      } else if (noProductsMessage) {
        noProductsMessage.style.display = 'none'; // Hide if there are products
      }
    });
  </script>

</body>

</html>

<?php
// Close the statement and connection
if (isset($stmt)) {
  $stmt->close();
}
if ($conn) {
  $conn->close();
}
?>