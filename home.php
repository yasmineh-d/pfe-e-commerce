<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Produit - Ventilador Mini</title>
  <link rel="stylesheet" href="css/description.css">
  <link rel="stylesheet" href="style.css"> {/* Assurez-vous que ce chemin est correct */}
  <!-- For Font Awesome icons used in the new header and footer, you might need to add this line: -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <!-- ========================
         NEW HEADER
    ======================== -->
  <header class="site-header">
    <div class="top-bar">
      <p>FREE SHIPPING FOR ORDERS OVER 40 €. FREE RETURNS OVER 60 DAYS.</p>
    </div>

    <div class="main-header">
      <div class="logo">
        <a href="home.php">
          <img src="images/logo_Y.png" alt="House Electronics Logo" /> {/* Make sure this image path is correct */}
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
          <a href="shopping_cart.php">
            <div class="icon-circle">
              <i class="fas fa-shopping-bag"></i>
            </div>
          </a>
          <a href="sign_in.php" class="signin-btn">Sign-in</a>
        </div>
      </div>
    </div>
  </header>

  <!-- ========================
         PAGE CONTAINER
    ======================== -->
  <div class="page-container">
    <!-- ========================
             BREADCRUMB HEADER
        ======================== -->
    <header class="breadcrumb-header">
      <h1>Categories</h1>
      <div class="header-controls">
        <svg class="dropdown-arrow" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
          <path d="M7 10l5 5 5-5H7z" />
        </svg>
        <svg class="search-icon" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
          <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
        </svg>
      </div>
    </header>

    <!-- ========================
             PAGE SUBHEADING
        ======================== -->
    <p class="page-subheading">Find your saved items and prepare to place your order.</p>

    <!-- ========================
             MAIN CONTENT (PRODUCT)
        ======================== -->
    <div class="main-content">
      <!-- ========================
                 PRODUCT IMAGE SECTION
            ======================== -->
      <div class="product-image-section">
        <img src="images/ventilator_mini1.png" alt="Main product image of a white mini fan with accessories" class="main-product-image">
        <div class="thumbnail-container">
          <img src="images/ventilator_mini2.png" alt="Thumbnail 1: Mini fan held in hand" class="thumbnail-image">
          <img src="images/ventilator_mini3.png" alt="Thumbnail 2: Mini fan next to a smartphone" class="thumbnail-image">
          <img src="images/ventilator_mini4.png" alt="Thumbnail 3: Instructions for the mini fan" class="thumbnail-image">
        </div>
      </div>

      <!-- ========================
                 PRODUCT DETAILS SECTION
            ======================== -->
      <div class="product-details-section">
        <h1 class="product-title">Ventilador_Mini</h1>
        <div class="description-label">Description</div>
        <p class="description-text">This is a portable mini handheld fan, designed for personal cooling. It features a compact, lightweight design with a circular blade guard for safety. The fan is USB rechargeable, making it convenient for travel, office, or outdoor use. Included accessories are a USB charging cable and a wrist strap for easy carrying</p>

        <div class="price-section">
          <span class="original-price">MAD 900.00</span>
          <span class="current-price">7834,94 DH</span>
        </div>

        <button class="buy-button">Buy</button>
      </div>
    </div>

    <!-- ========================
             REVIEWS SECTION
        ======================== -->
    <div class="reviews-section">
      <h2 class="reviews-title">Commentaires des clients</h2>

      <div class="rating-summary">
        <span class="rating-score">4.95</span>
        <div class="star-rating">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
      </div>

      <div class="rating-details">
        <div class="rating-item">
          <span class="rating-category">Polyvalence</span>
          <span class="rating-value">5.00</span>
        </div>
        <div class="rating-item">
          <span class="rating-category">Qualité</span>
          <span class="rating-value">5.00</span>
        </div>
        <div class="rating-item">
          <span class="rating-category">Ajustement</span>
          <span class="rating-value">5.00</span>
        </div>
      </div>

      <div class="local-reviews">
        <div class="local-reviews-left">
          <span>Voir les avis locaux <strong>4.95</strong></span>
          <div class="star-rating">
            <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
          </div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox" checked>
          <span class="slider"></span>
        </label>
      </div>

      <button class="review-button">Review</button>

      <h3 class="all-reviews-title">Tous les commentaires</h3>

      <div class="review-card">
        <div class="review-header">
          <span class="reviewer-name">M***e</span>
          <span class="review-date">19 Dec,2024</span>
        </div>
        <div class="review-stars">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="review-text">3 Speeds, rather correct for its size, perfect in the bag.</p>
      </div>

      <div class="review-card">
        <div class="review-header">
          <span class="reviewer-name">c***a</span>
          <span class="review-date">20 Dec,2024</span>
        </div>
        <div class="review-stars">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="review-text">I love it too it makes well of the wind and is rechargeable with cable</p>
      </div>

      <div class="review-card">
        <div class="review-header">
          <span class="reviewer-name">a***6</span>
          <span class="review-date">16 Dec,2024</span>
        </div>
        <div class="review-stars">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="review-text">Really very useful and looks good quality</p>
      </div>
    </div>
    <!-- End Page Container Div -->
  </div>

  <!-- ========================
         NEW FOOTER
    ======================== -->
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
            <a href="#"><img src="images/whatsapp-svgrepo-com.svg" alt="WhatsApp" /></a> {/* Ensure path is correct */}
            <a href="#"><img src="images/gmail-svgrepo-com.svg" alt="Gmail" /></a> {/* Ensure path is correct */}
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