<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homelectronique</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/sign_in.css" />
    <!-- Ensure 'sign_in.css' is the correct path to your CSS file -->
    <style>
      .forgot-password-link {
        display: block; /* Makes the link take its own line */
        margin-top: 15px; /* Adds space above the link */
        color: #555; /* A greyish color for the text */
        text-decoration: none; /* Removes the underline */
        font-size: 14px; /* Makes the font smaller */
        text-align: center; /* Centers only this link */
        cursor: pointer; /* Ywelli l'cursor 3la chkel yd */
      }
      .forgot-password-link:hover {
        text-decoration: underline; /* Adds underline on hover */
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

    <!-- ======================================================= -->
    <!--          CONTAINER LKBIR LI JAME3 KOULCHI (Auth)      -->
    <!-- ======================================================= -->
    <div class="auth-container">
      
      <!-- ======================================================= -->
      <!--          LJIHA LISSRYA: SECTION DYAL LES FORMS         -->
      <!-- ======================================================= -->
      <div class="form-section">
        
        <!-- ===== FORMULAIRE N°1: SIGN IN (Kayban f lowel) ===== -->
        <div id="signInFormContainer">
          <h1>Sign In</h1>
          <form action="#">
            <div class="input-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required />
            </div>
            <div class="input-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" class="btn btn-signup">Sign In</button>
            
            <!-- Lien li kay3iyet l JavaScript bach ybeddel l'form -->
            <a onclick="showForgotPasswordForm()" class="forgot-password-link">Forgot your password?</a>
          </form>
        </div>

        <!-- ===== FORMULAIRE N°2: FORGOT PASSWORD (Mkhabbi f lowel) ===== -->
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
              <!-- Lien bach trje3 l Sign In form -->
              <a onclick="showSignInForm()" class="forgot-password-link" style="margin-top:20px;">Back to Sign In</a>
            </form>
        </div>

      </div>

      <!-- ======================================================= -->
      <!--          LJIHA LIMNYA: MESSAGE D'ACCUEIL W SIGN UP    -->
      <!-- ======================================================= -->
      <div class="info-section">
        <h2>WELCOME BACK!</h2>
        <p>Already have an account click below to continue using the service.</p>
        <button
          onclick="window.location.href='sign_up.php'"
          class="btn btn-signin"
        >
          Sign Up
        </button>
      </div>
    </div>
    <!-- Auth Container End -->

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

    <!-- ================================================== -->
    <!--         HNA FIN KAYN L'CODE JAVASCRIPT             -->
    <!-- ================================================== -->
    <script>
      // Had l function kat khabbi l form dyal Sign In o kat beyyen dyal Forgot Password
      function showForgotPasswordForm() {
        document.getElementById('signInFormContainer').style.display = 'none';
        document.getElementById('forgotPasswordFormContainer').style.display = 'block';
      }

      // Had l function kat dir l3eks, kat rje3 l form dyal Sign In
      function showSignInForm() {
        document.getElementById('forgotPasswordFormContainer').style.display = 'none';
        document.getElementById('signInFormContainer').style.display = 'block';
      }
    </script>

  </body>
</html>