<?php
// L'MODIFICATION N°1: KANZIDO SESSION_START() F LOWEL DYAL LFILE KAMEL
session_start();
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
  <!-- Link l fichier CSS dyalek -->
  <link rel="stylesheet" href="css/home.css" />
</head>

<body>
  <div class="container">
    
    <!-- ======================================================= -->
    <!--                        HEADER                           -->
    <!-- ======================================================= -->
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
            <!-- This link opens the search overlay -->
            <a href="#" id="search-icon-link">
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

            <!-- L'MODIFICATION N°2: KANBEDLO L'BOUTON "SIGN-IN" B HAD L'CODE -->
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                <!-- Ila kan l'utilisateur dakhel, ghadi yban had l'bouton -->
                <a href="logout.php" class="signin-btn" style="background-color: #3771C8; border-color: #FFDD55; color: #FFDD55">Logout</a>
            <?php else: ?>
                <!-- Ila kan mamtsjelch, ghadi yban lih had l'bouton -->
                <a href="sign_in.php" class="signin-btn">Sign-in</a>
            <?php endif; ?>
            <!-- FIN DYAL L'MODIFICATION N°2 -->

          </div>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <!-- ======================================================= -->
    <!--                     HERO SECTION                        -->
    <!-- ======================================================= -->
    <section class="hero-section-purifier">
      <div class="nav-arrow left-arrow"><</div>
      <div class="nav-arrow right-arrow">></div>
      <div class="overlay">
        <div class="titlepurifier">
          <h1>Smart Air Purifier 4</h1>
        </div>
        <div class="content-block">
          <p class="subtitle">Breathe clean, healthy air</p>
          <p class="features">
            Purifies a large 20m² room in just 10 minutes<br />
            Smart controls | OLED display
          </p>
          <div class="linkshop">
            <a href="categories.php" class="shop-button">Shop Now</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Hero Section End -->

    <!-- ======================================================= -->
    <!--                 FEATURED CATEGORIES                     -->
    <!-- ======================================================= -->
    <section class="featured-categories">
      <div class="container">
        <h2 class="section-title">Featured Categories</h2>
        <div class="categories-grid">
          <a href="categories.php" class="category-item">
            <div class="category-image-wrapper">
              <img
                src="images/Small Appliances.jpeg"
                alt="Small Appliances"
                class="category-image" />
            </div>
            <p class="category-name">Small Appliances</p>
          </a>

          <a href="categories.php" class="category-item">
            <div class="category-image-wrapper">
              <img
                src="images/Kitchen_Appliances.png"
                alt="Kitchen Appliances"
                class="category-image" />
            </div>
            <p class="category-name">Kitchen Appliances</p>
          </a>

          <a href="categories.php" class="category-item">
            <div class="category-image-wrapper">
              <img
                src="images/laundry_Appliances.png"
                alt="Laundry Appliances"
                class="category-image" />
            </div>
            <p class="category-name">Laundry Appliances</p>
          </a>

          <a href="categories.php" class="category-item">
            <div class="category-image-wrapper">
              <img
                src="images/Heating_&_Air Conditioning.png"
                alt="Heating & Air Conditioning"
                class="category-image" />
            </div>
            <p class="category-name">Heating & Air Conditioning</p>
          </a>
        </div>
      </div>
    </section>
    <!-- Featured Categories Section End -->

    <!-- ======================================================= -->
    <!--                    RAMADAN SALE                         -->
    <!-- ======================================================= -->
    <section class="ramadan-sale">
      <div class="ramadan-sale-page-container">
        <h2 class="ramadan-sale-title">
          Ramadan Sale – Up to 50% Off <span class="moon-icon">🌙</span>
        </h2>
        <div class="product-carousel-wrapper">
          <button
            class="carousel-arrow prev-arrow"
            aria-label="Previous Product"><</button>
          <div class="product-carousel">
            <!-- Product Card 1: Vacuum Cleaner -->
            <div class="product-card">
              <a href="categories.php" class="product-image-link">
                <div class="product-image-container">
                  <img
                    src="images/Vacuum_cleaners.png"
                    alt="Vacuum Cleaner NEXO" />
                </div>
              </a>
              <h3 class="product-name">Vacuum_cleaners</h3>
              <div class="price-and-cart-container">
                <p class="product-price-sale">MAD 900.00<a href="categories.php" class="best-picks-add-icon" aria-label="Add Vacuum_cleaners to cart">
                    <i class="fas fa-shopping-bag"></i>
                  </a></p>
              </div>
              <p class="product-price-original">MAD 1,190.00</p>
              <div class="product-rating">
                <span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span>
              </div>
              <p class="product-status">Selling Fast</p>
            </div>

            <!-- Product Card 2: Toaster -->
            <div class="product-card">
              <a href="categories.php" class="product-image-link">
                <div class="product-image-container">
                  <img src="images/Toaster.png" alt="Toaster" />
                </div>
              </a>
              <h3 class="product-name">Toaster</h3>
              <div class="price-and-cart-container">
                <p class="product-price-sale">MAD 700.00 <a href="categories.php" class="best-picks-add-icon" aria-label="Add Toaster to cart">
                    <i class="fas fa-shopping-bag"></i>
                  </a></p>
              </div>
              <p class="product-price-original">MAD 800.00</p>
              <div class="product-rating">
                <span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span>
              </div>
              <p class="product-status">Selling Fast</p>
            </div>

            <!-- Product Card 3: Vacum -->
            <div class="product-card">
              <a href="categories.php" class="product-image-link">
                <div class="product-image-container">
                  <img src="images/vacum.png" alt="Vacum" />
                </div>
              </a>
              <h3 class="product-name">Vacum</h3>
              <div class="price-and-cart-container">
                <p class="product-price-sale">MAD 1,380.00 <a href="categories.php" class="best-picks-add-icon" aria-label="Add Vacum to cart">
                    <i class="fas fa-shopping-bag"></i>
                  </a></p>
              </div>
              <p class="product-price-original">MAD 1500.00</p>
              <div class="product-rating">
                <span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span>
              </div>
              <p class="product-status">Selling Fast</p>
            </div>

            <!-- Product Card 4: Vapeurcro (Iron) -->
            <div class="product-card">
              <a href="categories.php" class="product-image-link">
                <div class="product-image-container">
                  <img src="images/vapeurcro.png" alt="Vapeurcro Iron" />
                </div>
              </a>
              <h3 class="product-name">Vapeurcro</h3>
              <div class="price-and-cart-container">
                <p class="product-price-sale">MAD 500.00<a href="categories.php" class="best-picks-add-icon" aria-label="Add Vapeurcro to cart">
                    <i class="fas fa-shopping-bag"></i>
                  </a></p>
              </div>
              <p class="product-price-original">MAD 600.00</p>
              <div class="product-rating">
                <span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span><span class="star-icon">⭐</span>
              </div>
              <p class="product-status">Selling Fast</p>
            </div>
          </div>
          <button class="carousel-arrow next-arrow" aria-label="Next Product">></button>
        </div>
      </div>
    </section>
    <!-- Ramadan Sale Section End -->
    ======================================================= -->
    <!--                    BEST PICKS                           -->
    <!-- ======================================================= -->
    <section class="best-picks-section">
      <div class="ramadan-sale-page-container">
        <h2 class="best-picks-title">House-electronic's Best Picks</h2>
        <div class="product-carousel-wrapper">
          <button
            class="carousel-arrow prev-arrow best-picks-arrow"
            aria-label="Previous Product"><</button>
          <div class="product-carousel">
            <!-- Card 1: Thermomix -->
            <div class="best-picks-card">
              <div class="best-picks-img-container">
                <a href="categories.php"> <img src="images/Thermomix TM6.png" alt="Thermomix TM6" /></a>
              </div>
              <h3 class="best-picks-name">Thermomix TM6</h3>
              <div class="best-picks-footer">
                <span class="best-picks-price">MAD 11,380.00</span>
                <a href="categories.php" class="best-picks-add-icon"><i class="fas fa-shopping-bag"></i></a>
              </div>
            </div>

            <!-- Card 2: Stand Mixer -->
            <div class="best-picks-card">
              <div class="best-picks-img-container">
                <a href="categories.php"> <img src="images/Stand Mixer.png" alt="Stand Mixer" /></a>
              </div>
              <h3 class="best-picks-name">Stand Mixer</h3>
              <div class="best-picks-footer">
                <span class="best-picks-price">MAD 500.00</span>
                <a href="categories.php" class="best-picks-add-icon"><i class="fas fa-shopping-bag"></i></a>
              </div>
            </div>

            <!-- Card 3: Hair Dryer -->
            <div class="best-picks-card">
              <div class="best-picks-img-container">
                <a href="categories.php"> <img src="images/Hair_Dryer .png" alt="Hair Dryer" /></a>
              </div>
              <h3 class="best-picks-name">Hair Dryer</h3>
              <div class="best-picks-footer">
                <span class="best-picks-price">MAD 7,000.00</span>
                <a href="categories.php" class="best-picks-add-icon"><i class="fas fa-shopping-bag"></i></a>
              </div>
            </div>

            <!-- Card 4: Electric Kettle -->
            <div class="best-picks-card">
              <div class="best-picks-img-container">
                <a href="categories.php"> <img src="images/Electric Kettle.png" alt="Electric Kettle" /></a>
              </div>
              <h3 class="best-picks-name">Electric Kettle</h3>
              <div class="best-picks-footer">
                <span class="best-picks-price">MAD 380.00</span>
                <a href="categories.php" class="best-picks-add-icon"><i class="fas fa-shopping-bag"></i></a>
              </div>
            </div>
          </div>
          <button
            class="carousel-arrow next-arrow best-picks-arrow"
            aria-label="Next Product">></button>
        </div>
      </div>
    </section>
    <!-- Best Picks Section End -->

    <!-- ======================================================= -->
    <!--                   TESTIMONIALS                          -->
    <!-- ======================================================= -->
    <section class="testimonials-section">
      <h2 class="testimonials-main-title">
        Get discounts, services, and<br />tailored tools for your business
        stage.
      </h2>
      <div class="testimonials-wrapper">
        <button class="testimonial-arrow left-testimonial-arrow"><</button>
        <!-- Testimonial Card 1 -->
        <div class="testimonial-card">
          <div class="testimonial-top">
            <img
              src="images/photo_girl.jpg"
              alt="Emily Russell"
              class="testimonial-avatar" />
            <div class="testimonial-author-info">
              <p class="testimonial-author-name">Emily Russell</p>
              <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
            </div>
            <div class="testimonial-quote-icon">”</div>
          </div>
          <p class="testimonial-quote-text">
            “ The electronic appliances I purchased are of excellent quality.
            They're durable, efficient, and exactly as described on the
            website. I'll definitely shop here again! ”
          </p>
        </div>

        <!-- Testimonial Card 2 -->
        <div class="testimonial-card">
          <div class="testimonial-top">
            <img
              src="images/photo boy.jpg"
              alt="Mark Taylor"
              class="testimonial-avatar" />
            <div class="testimonial-author-info">
              <p class="testimonial-author-name">Mark Taylor</p>
              <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
            </div>
            <div class="testimonial-quote-icon">”</div>
          </div>
          <p class="testimonial-quote-text">
            “ A one-stop shop for home essentials. The prices are great, and
            the customer service is top-notch! ”
          </p>
        </div>
        <button class="testimonial-arrow right-testimonial-arrow">></button>
      </div>
    </section>
    <!-- Testimonials Section End -->

    <!-- ======================================================= -->
    <!--                 MEMBERSHIP PROMO                        -->
    <!-- ======================================================= -->
    <section class="membership-promo-section">
      <div class="promo-content">
        <p class="promo-text">
          Become a member – enjoy 10% off<br />
          Sign up for free
        </p>
        <a href="sign_up.php" class="promo-signup-btn">Sign Up</a>
      </div>
      <div class="promo-image">
        <img
          src="images/photo2.png"
          alt="Kitchen Appliances Collection" />
      </div>
    </section>
    <!-- Membership Promo Section End -->
  </div>

  </div>
  
  <!-- ======================================================= -->
  <!--                         FOOTER                          -->
  <!-- ======================================================= -->
  <footer id="contact" class="site-footer">
    <div class="footer-container">
      <div class="footer-main">
        <!-- ... (Lcode kamel dyal lfooter bla tighyir) ... -->
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->
<!-- Footer Section End -->
 <div id="search-overlay" class="search-overlay">
      <span id="close-search" class="close-btn">×</span>
      <div class="search-overlay-content">
          <input type="text" id="search-input" placeholder="Search for products..." autocomplete="off">
          <button type="submit" class="search-submit-btn"><i class="fas fa-search"></i></button>
      </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
