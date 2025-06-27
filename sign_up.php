<?php
// L'CODE PHP KAYB9A HNA LFO9, 9BEL AYI CODE HTML

// Kan vérifiw ila l'utilisateur clika 3la "Sign Up" (b tariqa POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ---- 1. Connexion à la base de données ----
    $servername = "localhost";
    $username = "root";
    $password_db = ""; // f XAMPP/WAMP l password kaykon khawi
    $dbname = "efm"; // Smiya dyal la base de données dyalek

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // ---- 2. Récupération et nettoyage des données du formulaire ----
    $nom = trim($_POST['full-name']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['number']);
    $password_text = trim($_POST['password']);

    // ---- 3. Hachage du mot de passe (Pour la sécurité) ----
    $hashed_password = password_hash($password_text, PASSWORD_BCRYPT);

    // ---- 4. Préparation et exécution de la requête SQL ----
    
    // ===== HNA L'MODIFICATION LWA7IDA: Beddelna "users" b "client" =====
    $sql = "INSERT INTO client (nom, email, telephone, password) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    // "ssss" kat3ni 4 variables dyal type String
    $stmt->bind_param("ssss", $nom, $email, $telephone, $hashed_password);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Ila tzad l'utilisateur b naja7, nsiftoh l page sign_in
        header("Location: sign_in.php?signup=success");
        exit(); // Important bach nwa9fo l'exécution dyal l script
    } else {
        // Ila l'email déja kayn, ghadi y3ti erreur
        if ($conn->errno == 1062) {
            echo "<script>alert('Erreur: Cet email est déjà utilisé !');</script>";
        } else {
            echo "<script>alert('Une erreur est survenue: " . $stmt->error . "');</script>";
        }
    }

    // Fermeture du statement et de la connexion
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homelectronique</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="css/sign_up.css" />
</head>

<body>
  <!-- Header Section Start -->
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
            <li><a href="home.php">Home <i class="fas fa-angle-down"></i></a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="categories.php">Categories <i class="fas fa-angle-down"></i></a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </nav>
        <div class="header-actions">
          <a href="#"><div class="icon-circle"><i class="fas fa-search"></i></div></a>
          <a href="#"><div class="icon-circle"><i class="far fa-heart"></i></div></a>
          <a href="shopping_cart.php"><div class="icon-circle"><i class="fas fa-shopping-bag"></i></div></a>
          <a href="sign_in.php" class="signin-btn">Sign-in</a>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- ======================================================= -->
  <!--          CONTAINER LKBIR LI JAME3 KOULCHI (Auth)      -->
  <!-- ======================================================= -->
  <div class="auth-container">
    <!-- ======================================================= -->
    <!--          LJIHA LISSRYA: FORM DYAL CREATE ACCOUNT      -->
    <!-- ======================================================= -->
    <div class="form-section">
      <h1>Create Account</h1>
      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="input-group">
          <label for="full-name">Full Name</label>
          <input type="text" id="full-name" name="full-name" required />
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="input-group">
          <label for="number">Number</label>
          <input type="tel" id="number" name="number" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit" class="btn btn-signup">Sign Up</button>
      </form>
    </div>

    <!-- Ljiha limnya katb9a kifma hiya -->
    <div class="info-section">
      <h2>WELCOME TO<br />ELECTRONIQUE<br />HOUSE</h2>
      <p>New Here ?</p>
      <button onclick="window.location.href='sign_in.php'" class="btn btn-signin">
        Sign In
      </button>
    </div>
  </div>
  <!-- Auth Container End -->

  <!-- Footer Section Start -->
  <footer id="contact" class="site-footer">
    <div class="footer-container">
        <div class="footer-main">
          <div class="footer-column"><h4>Get Help</h4><ul><li><a href="#">Help Center</a></li><li><a href="#">Live Chat</a></li><li><a href="#">Check Order Status</a></li><li><a href="#">Refunds</a></li><li><a href="#">Report Abuse</a></li></ul></div>
          <div class="footer-column"><h4>Catégorie</h4><ul><li><a href="#">Small Appliances</a></li><li><a href="#">Kitchen Appliances</a></li><li><a href="#">Laundry Appliances</a></li><li><a href="#">Heating and Air Conditioning</a></li></ul></div>
          <div class="footer-column"><h4>Payments and Protections</h4><ul><li><a href="#">Secure and Easy Payments</a></li><li><a href="#">Refund Policy</a></li><li><a href="#">On-Time Delivery</a></li><li><a href="#">After-Sales Protections</a></li><li><a href="#">Production Monitoring and Inspection Services</a></li></ul></div>
          <div class="footer-column"><h4>About the Company</h4><ul><li><a href="#">Who Are We?</a></li><li><a href="#">Social Responsibility</a></li></ul></div>
          <div class="footer-column"><h4>Contact</h4><div class="contact-icons"><a href="https://web.whatsapp.com/"><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp" /></a><a href="https://mail.google.com/"><img src="images/gmail-svgrepo-com.svg" alt="Gmail" /></a></div></div>
          <div class="footer-column"><h4>Follow Us</h4><div class="social-icons"><a href="https://www.facebook.com/?locale=fr_FR" class="social-icon facebook-bg"><i class="fab fa-facebook-f"></i></a><a href="https://twitter.com/" class="social-icon twitter-bg"><i class="fab fa-twitter"></i></a><a href="https://fr.linkedin.com/" class="social-icon linkedin-bg"><i class="fab fa-linkedin-in"></i></a><a href="https://www.instagram.com/" class="social-icon instagram-bg"><i class="fab fa-instagram"></i></a></div></div>
        </div>
        <hr class="footer-divider" />
        <div class="footer-bottom"><p class="copyright-text">© 2025 House Electronics. All Rights Reserved</p><div class="footer-legal-links"><a href="#">Terms & Conditions</a><span>|</span><a href="#">Privacy Policy</a></div></div>
      </div>
  </footer>
  <!-- Footer Section End -->
</body>
</html>