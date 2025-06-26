<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page Produit - Ventilador Mini</title>
    <!-- HNA FIN KAN L'LINK DYAL CSS, 7EYEDTO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    
    <!-- ============================================= -->
    <!-- ==== HNA KAYBDA L'CODE CSS L'DAKHILI ======== -->
    <!-- ============================================= -->
    <style>
      /* ========================================================== */
      /* == STYLES GLOBALES & FIX DYAL LAYOUT (L'ISLAH L2ASASI) == */
      /* ========================================================== */

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      /* 
        *** HAD L'CODE Jdide HOWA LMOCHIM *** 
        Kaykhlli l'page dima twila 7ta lte7t o kaydfe3 l'footer
      */
      html {
        height: 100%; /* Kay3awen bach 100vh tkhdem mzyan f ga3 l'browsers */
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: #f5f5f5; /* Light grey background */
        color: #333;
        display: flex; /* Kanst3mlo Flexbox */
        flex-direction: column; /* Kan7to l3anassir fo9 b3diyathom */
        min-height: 100vh; /* L'body dima ghadi iakhod 3la l2a9al tol dyal l'ecran kaml */
      }

      /* 
        *** HAD L'CODE Jdide HOWA LMOCHIM *** 
        Hada kaykhlli l'mo7tawa lwestani (white box) ikber o idfe3 l'footer lte7t
      */
      .page-container {
        flex-grow: 1; /* HADI HIYA L'KHADMA! Katkhlli had l'3onssor iakhod l'espace lkhawi */
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
      }


      /* ========================================================================== */
      /* == HEADER STYLES (Code Jdid) == */
      /* ========================================================================== */

      /* ========================
        TOP BAR (Blue strip)
      ======================== */
      .top-bar {
        background-color: #3771c8;
        color: #fcd34d;
        text-align: center;
        font-size: 0.9rem;
        padding: 8px 0;
      }

      /* ========================
        MAIN HEADER AREA
      ======================== */
      .main-header {
        background-color: #3771c8;
        padding: 0 20px;
        display: flex;
        align-items: flex-start; /* Changed from center to flex-start for logo alignment */
        gap: 1px; /* Reduced gap for closer alignment if needed */
        flex-wrap: wrap; /* Allow wrapping for responsiveness */
      }

      .header-content {
        background-color: #ffffff;
        border-radius: 30px 0px 0px 0px;
        padding: 12px 30px; /* Reduced vertical padding slightly */
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-grow: 1;
        margin-left: 20px; /* Space between logo and content area */
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05); /* Soft shadow */
      }

      /* ========================
        LOGO
      ======================== */
      .logo img {
        max-height: 57px; /* Original height */
        margin-left: 9px; /* Spacing from the edge */
        margin-top: -15px; /* Adjust to align with the white header content visually */
        position: relative; /* Allows z-index if ever needed over other elements */
        /* display: block; */ /* Ensures no extra space below image */
      }

      /* ========================
        NAVIGATION
      ======================== */
      .nav-menu ul {
        list-style: none;
        display: flex;
        gap: 115px; /* Adjust gap as needed for your desired spacing */
      }

      .nav-menu ul li a {
        text-decoration: none;
        font-weight: 500;
        color: #000;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 13px; /* Space between text and icon */
        position: relative; /* For the active indicator */
      }

      .nav-menu ul li a:hover,
      .nav-menu ul li a.active {
        color: #1e90ff; /* Example hover/active color */
      }

      /* Optional: Active link indicator */
      .nav-menu ul li a.active::after {
        content: "";
        display: block;
        height: 2px;
        width: 100%;
        background: #000; /* Color of the underline */
        position: absolute;
        bottom: -5px; /* Position below the text */
        left: 0;
      }

      /* ========================
        ICON BUTTONS (Search, Heart, Bag)
      ======================== */
      .header-actions {
        display: flex;
        align-items: center;
        gap: 45px; /* Spacing between icons and sign-in button */
      }

      .icon-circle {
        background-color: #f1f3f6; /* Light grey background for icons */
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s ease;
      }

      .icon-circle i {
        font-size: 1rem; /* Adjust icon size if needed */
        color: #000;
      }

      .icon-circle:hover {
        background-color: #e0e7ff; /* Slightly darker on hover */
      }

      /* ========================
        SIGN-IN BUTTON
      ======================== */
      .signin-btn {
        padding: 6px 16px;
        border: 1px solid #3771c8;
        color: #3771c8;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
      }

      .signin-btn:hover {
        background-color: #ffdd55; /* Yellow accent on hover */
        color: #3771c8; /* Keep text color or change as desired */
        /* border-color: #ffdd55; */ /* Optional: change border color on hover */
      }

      /* ========================
        RESPONSIVE DESIGN (HEADER)
      ======================== */
      @media (max-width: 992px) {
        /* Adjust breakpoint as needed */
        .nav-menu ul {
          gap: 40px; /* Reduce gap for medium screens */
        }
        .header-actions {
          gap: 20px; /* Reduce gap for medium screens */
        }
      }

      @media (max-width: 768px) {
        .main-header {
          flex-direction: column;
          align-items: flex-start; /* Align logo to the start */
        }

        .logo img {
          margin-top: 5px; /* Reset top margin for stacked layout */
          margin-bottom: 10px; /* Add some space below logo */
        }

        .header-content {
          flex-direction: column;
          align-items: flex-start; /* Align nav and actions to the start */
          gap: 15px;
          padding: 20px;
          border-radius: 30px; /* Or adjust to fit the new layout */
          margin-left: 0; /* Remove margin when stacked */
          width: 100%; /* Make header content take full width */
        }

        .nav-menu ul {
          flex-direction: column;
          gap: 10px; /* Adjust gap for vertical nav */
          width: 100%; /* Make nav take full width */
        }
        .nav-menu ul li a {
          justify-content: flex-start; /* Align nav items text to left */
        }

        .header-actions {
          flex-direction: row; /* Keep actions in a row */
          justify-content: flex-start; /* Align actions to the start */
          width: 100%;
          gap: 10px; /* Adjust gap for smaller screens */
          flex-wrap: wrap; /* Allow actions to wrap if they don't fit */
        }
      }


      /* ========================================================== */
      /* == STYLES DYAL LMO7TAWA (CONTENT) == */
      /* ========================================================== */

      .breadcrumb-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
      }

      .breadcrumb-header h1 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
      }

      .header-controls {
        display: flex;
        align-items: center;
        gap: 15px;
      }

      .dropdown-arrow,
      .search-icon {
        width: 20px;
        height: 20px;
        color: #666;
        cursor: pointer;
      }

      .page-subheading {
        padding: 15px 20px;
        font-size: 14px;
        color: #666;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
      }

      .main-content {
        display: flex;
        padding: 20px;
        gap: 30px;
        max-width: 1000px;
        margin: 20px auto; /* Zedt chwia d margin lfo9 */
      }

      .product-image-section {
        flex: 1;
        max-width: 400px;
      }

      .main-product-image {
        width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
      }

      .thumbnail-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      .thumbnail-image {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e0e0e0;
        cursor: pointer;
        transition: border-color 0.2s;
      }

      .thumbnail-image:hover, .thumbnail-image:focus {
        border-color: #4285f4;
      }

      .product-details-section {
        flex: 1;
        max-width: 500px;
      }

      .product-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #333;
      }

      .description-label {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
      }

      .description-text {
        font-size: 14px;
        line-height: 1.5;
        color: #666;
        margin-bottom: 20px;
      }

      .price-section {
        margin-bottom: 20px;
      }

      .original-price {
        color: #999;
        text-decoration: line-through;
        font-size: 14px;
        margin-right: 10px;
      }

      .current-price {
        color: #e74c3c;
        font-size: 20px;
        font-weight: 700;
      }

      .buy-button {
        background: linear-gradient(135deg, #4285f4, #5a67d8);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
        width: 100%;
        margin-bottom: 30px;
      }

      .buy-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(66, 133, 244, 0.4);
      }

      .reviews-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin: 0 20px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }

      .reviews-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
      }

      .rating-summary {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
      }

      .rating-score {
        font-size: 32px;
        font-weight: 700;
        color: #4285f4;
      }

      .star-rating {
        display: flex;
        gap: 2px;
      }

      .star {
        color: #ffc107;
        font-size: 18px;
      }

      .rating-details {
        display: flex;
        gap: 30px;
        margin-bottom: 20px;
        font-size: 13px;
      }

      .rating-item {
        text-align: center;
      }

      .rating-category {
        display: block;
        color: #666;
        margin-bottom: 4px;
        font-weight: 500;
      }

      .rating-value {
        font-weight: 700;
        color: #333;
      }

      .local-reviews {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        font-size: 14px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
      }

      .local-reviews-left {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .toggle-switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
      }

      .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc; /* Unchecked state color */
        transition: 0.4s;
        border-radius: 22px;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
      }

      input:checked + .slider {
          background-color: #4285f4; /* Checked state color */
      }

      input:checked + .slider:before {
        transform: translateX(18px);
      }

      .review-button {
        background: linear-gradient(135deg, #4285f4, #5a67d8);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-bottom: 25px;
      }

      .all-reviews-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
      }

      .review-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 12px;
        border-left: 4px solid #4285f4;
      }

      .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
      }

      .reviewer-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
      }

      .review-date {
        font-size: 12px;
        color: #666;
      }

      .review-text {
        font-size: 13px;
        line-height: 1.5;
        color: #555;
        margin-top: 8px;
      }

      .review-stars {
        margin: 6px 0;
      }


      /* ========================
        SITE FOOTER SECTION (Code Jdid)
      ======================== */
      .site-footer {
        background-color: #3771c8; /* Main blue from header */
        color: #ffffff;
        padding: 60px 0 20px 0;
        font-family: Arial, sans-serif;
      }

      .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
      }

      .footer-main {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
        margin-bottom: 40px;
      }

      .footer-column {
        flex: 1;
        min-width: 160px; /* Prevent columns from getting too narrow */
      }

      .footer-column h4 {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #fff;
      }

      .footer-column ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .footer-column ul li {
        margin-bottom: 12px;
      }

      .footer-column ul li a,
      .footer-legal-links a {
        color: #d1d5db; /* A slightly off-white for links */
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
      }

      .footer-column ul li a:hover,
      .footer-legal-links a:hover {
        color: #ffffff;
        text-decoration: underline;
      }

      /* Styles for stacking contact icon links (WhatsApp, Gmail) */
      .footer-column .contact-icons a {
        display: block; /* Makes each link take full width and stack vertically */
        margin-bottom: 10px; /* Space between the links */
      }
      .footer-column .contact-icons a:last-child {
        margin-bottom: 0; /* Remove margin from the last icon if only two */
      }

      .contact-icons img {
        width: 36px;
        height: auto;
        display: block; /* Ensures the image behaves as a block within its 'a' tag */
        transition: transform 0.2s ease; /* For smooth scaling on hover */
      }

      .footer-column .contact-icons a:hover img {
        transform: scale(1.15); /* Make icon bigger on hover */
      }

      /* Social icons */
      .social-icons .social-icon {
        display: flex; /* Keeps icons in a row if space allows or stacks with flex-wrap */
        justify-content: center;
        align-items: center;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        margin-right: 8px; /* Space between horizontal icons */
        margin-bottom: 8px; /* Space for wrapping */
        color: #fff;
        font-size: 1.1rem;
        text-decoration: none;
        transition: transform 0.2s ease;
      }
      .social-icons .social-icon:hover {
        transform: scale(1.1);
      }

      .facebook-bg {
        background-color: #1877f2;
      }
      .twitter-bg {
        background-color: #1da1f2;
      }
      .linkedin-bg {
        background-color: #0a66c2;
      }
      .instagram-bg {
        background: radial-gradient(
          circle at 30% 107%,
          #fdf497 0%,
          #fdf497 5%,
          #fd5949 45%,
          #d6249f 60%,
          #285aeb 90%
        );
      }

      .footer-divider {
        border: none;
        height: 1px;
        background-color: rgba(255, 255, 255, 0.2);
        margin: 0 0 20px 0;
      }

      .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        font-size: 0.85rem;
        color: #d1d5db;
      }

      .footer-legal-links span {
        margin: 0 10px;
      }

      /* Responsive adjustments for Footer */
      @media (max-width: 992px) {
        .footer-column {
          flex-basis: calc(33.333% - 20px); /* Adjust for 3 columns with gap */
          min-width: 180px;
        }
      }

      @media (max-width: 768px) {
          /* Responsive Content */
          .main-content {
              flex-direction: column;
              padding: 15px;
              gap: 20px;
          }
          .product-details-section,
          .product-image-section {
              max-width: none;
          }
          .rating-details {
              gap: 15px;
          }
          /* Responsive Footer */
          .footer-main {
              gap: 20px; /* Reduce gap between columns */
          }
          .footer-column {
              flex-basis: calc(50% - 10px); /* Adjust for 2 columns with gap */
              min-width: 150px;
          }
          .footer-column h4 {
              font-size: 0.95rem; /* Slightly smaller heading */
          }
          .footer-bottom {
              flex-direction: column; /* Stack bottom items */
              text-align: center;
              gap: 10px;
          }
          .footer-legal-links {
              justify-content: center;
          }
      }

      @media (max-width: 576px) {
        .footer-main {
          flex-direction: column; /* Stack all columns */
          align-items: flex-start; /* Align columns to the start */
          gap: 30px;
        }
        .footer-column {
          flex-basis: 100%; /* Each column takes full width */
          min-width: unset;
        }
        .footer-column h4 {
          margin-bottom: 15px;
        }
        .footer-column ul li {
          margin-bottom: 10px;
        }
        /* For contact and social icons on smallest screens, ensure they are visible */
        .footer-column .contact-icons,
        .footer-column .social-icons {
          display: flex; /* Or inline-flex if you prefer them side-by-side if space */
          flex-wrap: wrap; /* Allow wrapping */
          gap: 10px; /* Space between icons */
        }
        .footer-column .contact-icons a,
        .footer-column .social-icons .social-icon {
          margin-bottom: 0; /* Reset bottom margin since gap handles spacing */
        }
      }
    </style>
    <!-- ============================================= -->
    <!-- ==== HNA KAYSSALI L'CODE CSS L'DAKHILI ======= -->
    <!-- ============================================= -->
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
    <!-- Header Section End -->

    <!-- Page Container -->
    <div class="page-container">
        <!-- Breadcrumb Header -->
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

        <!-- Page Subheading -->
        <p class="page-subheading">
            Find your saved items and prepare to place your order.
        </p>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Product Image Section -->
            <div class="product-image-section">
    <!-- HNA GHATDIR SMIYA DYAL TSAWIRA L'KBIRA -->
    <img src="images/Ventilador_Mini" alt="Main product image of a white mini fan with accessories" class="main-product-image" />
    
    <div class="thumbnail-container">
        <!-- O HNA SMIYAT DYAL TSAWER SGHAR -->
        <img src="images/Ventilador_Mini.png" alt="Thumbnail 1: Mini fan held in hand" class="thumbnail-image" />
        <img src="images/Ventilador_Mini" alt="Thumbnail 2: Mini fan next to a smartphone" class="thumbnail-image" />
        <img src="images/Ventilador_Mini" alt="Thumbnail 3: Instructions for the mini fan" class="thumbnail-image" />
        <img src="images/ventilator_mini4" alt="Thumbnail 4: Product view" class="thumbnail-image" />
    </div>
</div>

            <!-- Product Details Section -->
            <div class="product-details-section">
                <h1 class="product-title">Ventilador_Mini</h1>
                <div class="description-label">Description</div>
                <p class="description-text">
                    This is a portable mini handheld fan, designed for personal cooling. It features a compact, lightweight design with a circular blade guard for safety. The fan is USB rechargeable, making it convenient for travel, office, or outdoor use. Included accessories are a USB charging cable and a wrist strap for easy carrying.
                </p>

                <div class="price-section">
                    <span class="original-price">MAD 900.00</span>
                    <span class="current-price">150.94 DH</span>
                </div>
                <form action="shopping_cart.php" method="post" class="buy-form">
                    <input type="hidden" name="product_name" value="Ventilador_Mini">
                    <input type="hidden" name="product_price" value="150.94">
                    <input type="hidden" name="product_image" value="images/Ventilador_Mini.png">
                    <button type="submit" class="buy-button">Buy</button>
                </form>
            </div>
        </div>

        <!-- Reviews Section -->
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
                    <input type="checkbox" checked />
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
                <p class="review-text">
                    3 Speeds, rather correct for its size, perfect in the bag.
                </p>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <span class="reviewer-name">c***a</span>
                    <span class="review-date">20 Dec,2024</span>
                </div>
                <div class="review-stars">
                    <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                </div>
                <p class="review-text">
                    I love it too it makes well of the wind and is rechargeable with cable
                </p>
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
    </div>

    <!-- Footer Section Start -->
    <footer class="site-footer">
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
                        <li><a href="#">Production Monitoring and Inspection Services</a></li>
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
                        <a href="#"><i class="fab fa-whatsapp" style="font-size: 24px; color: #25d366;"></i></a>
                        <a href="#"><i class="fas fa-envelope" style="font-size: 24px; color: #ea4335;"></i></a>
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
    <!-- Footer Section End -->

    <!-- JavaScript for image switching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainProductImage = document.querySelector('.main-product-image');
            const thumbnailImages = document.querySelectorAll('.thumbnail-image');

            thumbnailImages.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    mainProductImage.src = this.src;
                });
            });
        });
    </script>
</body>

</html>