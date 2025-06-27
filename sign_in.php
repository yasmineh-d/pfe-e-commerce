<?php
// ===== 1. KANBDAMO SESSION =====
session_start();

// Ghadi nkhliw had variable khawya, ghadi n3emroha ila kan chi ghalat
$error_message = "";

// ===== 2. KANVÉRIFIW ILA L'UTILISATEUR CLIKA 3LA BUTTON "Sign In" =====
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ---- Connexion à la base de données ----
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "efm";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // ---- Récupération des données du formulaire ----
    $email = trim($_POST['email']);
    $password_text = trim($_POST['password']);

    // ---- Préparation de la requête SQL (b tariqa amina) ----
    // === HNA L'MODIFICATION LWA7IDA: Beddelna "id" b "id_client" ===
    $sql = "SELECT id_client, nom, email, password FROM client WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // ---- Vérification des résultats ----
    if ($result->num_rows == 1) {
        // L9ina l'utilisateur, daba ghadi n vérifiw l password
        $user = $result->fetch_assoc();

        if (password_verify($password_text, $user['password'])) {
            // Lkolchi s7i7!

            // === HNA L'MODIFICATION TANYA: Beddelna $user['id'] b $user['id_client'] ===
            $_SESSION['user_id'] = $user['id_client'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['is_logged_in'] = true;

            // Kansiftoh l page dyal l'accueil (home.php)
            header("Location: home.php");
            exit();

        } else {
            // L password ghalet
            $error_message = "L'email ou le mot de passe est incorrect.";
        }
    } else {
        // L'email makaynch f la base de données
        $error_message = "L'email ou le mot de passe est incorrect.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homelectronique - Sign In</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/sign_in.css" />
    <style>
      .forgot-password-link {
        display: block;
        margin-top: 15px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        text-align: center;
        cursor: pointer;
      }
      .forgot-password-link:hover {
        text-decoration: underline;
      }
      .error-message { /* Style jdid bach nbayno l'erreur */
        color: #D8000C;
        background-color: #FFD2D2;
        border: 1px solid #D8000C;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
      }
    </style>
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
            <a href="sign_up.php" class="signin-btn">Sign-in</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <div class="auth-container">
      <div class="form-section">
        
        <div id="signInFormContainer">
          <h1>Sign In</h1>

          <?php
          // HNA FIN GHADI NBAYNO MESSAGE DYAL L'ERREUR ILA KAN
          if (!empty($error_message)) {
              echo '<div class="error-message">' . $error_message . '</div>';
          }
          ?>
          
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required />
            </div>
            <div class="input-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" class="btn btn-signup">Sign In</button>
            <a onclick="showForgotPasswordForm()" class="forgot-password-link">Forgot your password?</a>
          </form>
        </div>

        <div id="forgotPasswordFormContainer" style="display: none;">
            <h1>Forgot Password</h1>
            <p style="text-align: center; margin-bottom: 20px; color: #666;">Enter your email and phone number to reset your password.</p>
            <form action="#">
              <div class="input-group">
                <label for="reset-email">Your Email</label>
                <input type="email" id="reset-email" name="email" required />
              </div>
              <div class="input-group">
                <label for="phone">Your Phone Number</label>
                <input type="tel" id="phone" name="phone" required />
              </div>
              <button type="submit" class="btn btn-signup">Send Reset Instructions</button>
              <a onclick="showSignInForm()" class="forgot-password-link" style="margin-top:20px;">Back to Sign In</a>
            </form>
        </div>
      </div>

      <div class="info-section">
        <h2>WELCOME BACK!</h2>
        <p>Don't have an account yet? Join us!</p>
        <button onclick="window.location.href='sign_up.php'" class="btn btn-signin">
          Sign Up
        </button>
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
          <!-- Other footer columns... -->
          <div class="footer-column"><h4>Catégorie</h4><ul><li><a href="#">Small Appliances</a></li><li><a href="#">Kitchen Appliances</a></li><li><a href="#">Laundry Appliances</a></li><li><a href="#">Heating and Air Conditioning</a></li></ul></div>
          <div class="footer-column"><h4>Payments and Protections</h4><ul><li><a href="#">Secure and Easy Payments</a></li><li><a href="#">Refund Policy</a></li><li><a href="#">On-Time Delivery</a></li><li><a href="#">After-Sales Protections</a></li><li><a href="#">Production Monitoring and Inspection Services</a></li></ul></div>
          <div class="footer-column"><h4>About the Company</h4><ul><li><a href="#">Who Are We?</a></li><li><a href="#">Social Responsibility</a></li></ul></div>
          <div class="footer-column"><h4>Contact</h4><div class="contact-icons"><a href="#"><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp"/></a><a href="#"><img src="images/gmail-svgrepo-com.svg" alt="Gmail"/></a></div></div>
          <div class="footer-column"><h4>Follow Us</h4><div class="social-icons"><a href="#" class="social-icon facebook-bg"><i class="fab fa-facebook-f"></i></a><a href="#" class="social-icon twitter-bg"><i class="fab fa-twitter"></i></a><a href="#" class="social-icon linkedin-bg"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-icon instagram-bg"><i class="fab fa-instagram"></i></a></div></div>
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
    <!-- Footer Section End -->
    
    <script>
      function showForgotPasswordForm() {
        document.getElementById('signInFormContainer').style.display = 'none';
        document.getElementById('forgotPasswordFormContainer').style.display = 'block';
      }

      function showSignInForm() {
        document.getElementById('forgotPasswordFormContainer').style.display = 'none';
        document.getElementById('signInFormContainer').style.display = 'block';
      }
    </script>
  </body>
</html>