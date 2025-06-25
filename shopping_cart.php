<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "efm";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Échec de la connexion : " . $e->getMessage());
}

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'], $_POST['product_id']) && isset($_SESSION['cart'][$_POST['product_id']])) {
    $productId = intval($_POST['product_id']);
    if ($_POST['action'] === 'increment') {
      $_SESSION['cart'][$productId]['quantity'] += 1;
    } elseif ($_POST['action'] === 'decrement' && $_SESSION['cart'][$productId]['quantity'] > 1) {
      $_SESSION['cart'][$productId]['quantity'] -= 1;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }

  // Handle promo code submission
  if (isset($_POST['apply_promo'])) {
    $enteredCode = strtoupper(trim($_POST['promo_code'] ?? ''));

    if ($enteredCode === '') {
      // User cleared the field, so remove promo
      unset($_SESSION['applied_promo']);
      unset($_SESSION['promo_error']);
    } else {
      $promoStmt = $conn->prepare("SELECT * FROM promo_codes WHERE code = ? AND is_active = 1 AND (expires_at IS NULL OR expires_at > NOW())");
      $promoStmt->execute([$enteredCode]);
      $promo = $promoStmt->fetch(PDO::FETCH_ASSOC);

      if ($promo) {
        $_SESSION['applied_promo'] = $promo;
        unset($_SESSION['promo_error']);
      } else {
        $_SESSION['promo_error'] = "Invalid or expired promo code.";
        unset($_SESSION['applied_promo']);
      }
    }


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }

  // Handle shipping selection
  if (isset($_POST['shipping_method'])) {
    $_SESSION['shipping_method'] = ($_POST['shipping_method'] === 'fast') ? 'fast' : 'standard';
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }
}

// Load cart products
$details = [];
$totalItems = 0;
$totalCost = 0;

if (!empty($_SESSION['cart'])) {
  $productIds = array_keys($_SESSION['cart']);
  $placeholders = implode(',', array_fill(0, count($productIds), '?'));

  $sql = "SELECT id_Produit, libelle_Produit, prix_de_vente, image 
            FROM produit 
            WHERE id_Produit IN ($placeholders)";
  $stmt = $conn->prepare($sql);
  $stmt->execute($productIds);
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($products as $product) {
    $id = $product['id_Produit'];
    $quantity = $_SESSION['cart'][$id]['quantity'];
    $price = $product['prix_de_vente'];
    $itemTotal = $quantity * $price;

    $details[] = [
      'id' => $id,
      'libelle_Produit' => $product['libelle_Produit'],
      'image' => $product['image'],
      'prix' => $price,
      'quantite' => $quantity,
      'total' => $itemTotal
    ];

    $totalItems += $quantity;
    $totalCost += $itemTotal;
  }
}

// Promo logic
$discountValue = 0;
$appliedPromo = $_SESSION['applied_promo'] ?? null;

if ($appliedPromo && $totalCost > 0) {
  if ($appliedPromo['discount_type'] === 'percent') {
    $discountValue = $totalCost * ($appliedPromo['discount_value'] / 100);
  } else {
    $discountValue = min($appliedPromo['discount_value'], $totalCost);
  }
}

// Shipping logic (STAND DELIVERY)
$shippingMethod = $_SESSION['shipping_method'] ?? 'standard';
$shippingCost = $shippingMethod === 'fast' ? 100 : 50;


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="css/shopping_cart.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <header class="site-header">
    <div class="top-bar">
      <p>FREE SHIPPING FOR ORDERS OVER 40 €. FREE RETURNS OVER 60 DAYS.</p>
    </div>

    <div class="main-header">
      <div class="logo">
        <a href="home.php">
          <img src="images/logo_Y.png" alt="House Electronics Logo" />
        </a>
      </div>
      <div class="header-content">
        <nav class="nav-menu">
          <ul>
            <li>
              <a href="home.php">Home <i class="fas fa-angle-down"></i></a>
            </li>
            <li><a href="about.php">About</a></li>
            <li>
              <a href="categories.php">Categories <i class="fas fa-angle-down"></i></a>
            </li>
            <li><a href="#contact">Contact</a></li>
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
          <a href="#">
            <div class="icon-circle">
              <i class="fas fa-shopping-bag"></i>
            </div>
          </a>
          <a href="sign_in.php" class="signin-btn">Sign-in</a>
        </div>
      </div>
    </div>
  </header>

  <div class="container">



    <div class="shopping-cart-section">
      <div class="cart-header">
        <h1>Shopping Cart</h1>
        <span class="item-count"><?= $totalItems ?> Items</span>
      </div>
      <hr />
      <div class="cart-table-headers">
        <span class="header-details">PRODUCT DETAILS</span>
        <span class="header-quantity">QUANTITY</span>
        <span class="header-price">PRICE</span>
        <span class="header-total">TOTAL</span>
      </div>

      <?php if (!empty($details)): ?>
        <?php foreach ($details as $row): ?>
          <div class="cart-item">
            <div class="product-details">
              <img src="<?= htmlspecialchars($row['image'] ?? 'https://via.placeholder.com/80') ?>" alt="<?= htmlspecialchars($row['libelle_Produit']) ?>" />
              <div class="info">
                <span class="product-name"><?= htmlspecialchars($row['libelle_Produit']) ?></span>
              </div>
            </div>
            <div class="quantity-selector">
              <!-- Decrement -->
              <form method="post">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="action" value="decrement">
                <button type="submit" <?= $row['quantite'] <= 1 ? 'disabled' : '' ?>>-</button>
              </form>

              <!-- Quantity Display -->
              <input type="text" value="<?= $row['quantite'] ?>" readonly />

              <!-- Increment -->
              <form method="post">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="action" value="increment">
                <button type="submit">+</button>
              </form>
            </div>
            <div class="item-price"><?= number_format($row['prix'], 2) ?> DH</div>
            <div class="item-total"><?= number_format($row['total'], 2) ?> DH</div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 20px; text-align: center;">Your cart is empty.</p>
      <?php endif; ?>
    </div>

    <div class="order-summary-section">
      <h2>Order Summary</h2>
      <hr />
      <div class="summary-line">
        <span class="label">ITEMS <?= $totalItems ?></span>
        <span class="value"><?= number_format($totalCost, 2) ?> DH</span>
      </div>

      <form method="post" style="margin-bottom: 10px;">
        <div class="summary-line">
          <span class="label">SHIPPING</span>
          <select name="shipping_method" onchange="this.form.submit()">
            <option value="standard" <?= $shippingMethod === 'standard' ? 'selected' : '' ?>>Standard Delivery - 50.00 DH</option>
            <option value="fast" <?= $shippingMethod === 'fast' ? 'selected' : '' ?>>Fast Delivery - 100.00 DH</option>
          </select>
        </div>
      </form>

      <form method="post">
        <span class="promo-label">PROMO CODE</span>
        <input type="text" name="promo_code" placeholder="Enter your code" value="<?= htmlspecialchars($appliedPromo['code'] ?? '') ?>" />
        <button type="submit" name="apply_promo" class="apply-button">APPLY</button>
        <?php if (isset($_SESSION['promo_error'])): ?>
          <p style="color:red; font-size: 14px;"><?= $_SESSION['promo_error'];
                                                  unset($_SESSION['promo_error']); ?></p>
        <?php elseif ($appliedPromo): ?>
          <p style="color:green; font-size: 14px;">Promo "<strong><?= htmlspecialchars($appliedPromo['code']) ?></strong>" applied (−<?= number_format($discountValue, 2) ?> DH)</p>
        <?php endif; ?>
      </form>

      <?php if ($discountValue > 0): ?>
        <div class="summary-line">
          <span class="label">DISCOUNT</span>
          <span class="value">−<?= number_format($discountValue, 2) ?> DH</span>
        </div>
      <?php endif; ?>

      <div class="summary-line">
        <span class="label">DELIVERY</span>
        <span class="value"><?= number_format($shippingCost, 2) ?> DH</span>
      </div>

      <hr />

      <div class="summary-line total-cost-line">
        <span class="label">TOTAL COST</span>
        <span class="value"><?= number_format(($totalCost - $discountValue) + $shippingCost, 2) ?> DH</span>
      </div>

      <button class="checkout-button">CHECKOUT</button>
    </div>
  </div>

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
            <li><a href="#">Small Appliances</a></li>
            <li><a href="#">Kitchen Appliances</a></li>
            <li><a href="#">Laundry Appliances</a></li>
            <li><a href="#">Heating and Air Conditioning</a></li>
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
            <li><a href="#">Who Are We?</a></li>
            <li><a href="#">Social Responsibility</a></li>
          </ul>
        </div>

        <!-- Column 5: Contact -->
        <div class="footer-column">
          <h4>Contact</h4>
          <div class="contact-icons">
            <a href="#"><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp" /></a>
            <a href="#"><img src="images/gmail-svgrepo-com.svg" alt="Gmail" /></a>
          </div>
        </div>

        <!-- Column 6: Follow Us -->
        <div class="footer-column">
          <h4>Follow Us</h4>
          <div class="social-icons">
            <a href="#" class="social-icon facebook-bg"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon twitter-bg"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="social-icon instagram-bg"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>

      <hr class="footer-divider" />

      <div class="footer-bottom">
        <p class="copyright-text">
          © 2025 House Electronics. All Rights Reserved
        </p>
        <div class="footer-legal-links">
          <a href="#">Terms & Conditions</a>
          <span>|</span>
          <a href="#">Privacy Policy</a>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>