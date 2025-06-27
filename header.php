<?php
// Dima kanbdaw b session f lheader
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
  <!-- Had l'CSS khasso ykon 3am, machi ghir home.css. Bhal style.css -->
  <link rel="stylesheet" href="css/home.css" /> 
</head>
<body>
  <div class="container">
    
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
              <li><a href="home.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="categories.php">Categories</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </nav>

          <div class="header-actions">
            <a href="#" id="search-icon-link">
              <div class="icon-circle"><i class="fas fa-search"></i></div>
            </a>
            <a href="#"><div class="icon-circle"><i class="far fa-heart"></i></div></a>
            <a href="shopping_cart.php"><div class="icon-circle"><i class="fas fa-shopping-bag"></i></div></a>
            
            <!-- HNA L'CODE DYNAMIQUE Jdid -->
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                <!-- Ila kan dakhel, nbayno Logout -->
                <a href="logout.php" class="signin-btn" style="background-color: #e74c3c; border-color: #c0392b;">Logout</a>
            <?php else: ?>
                <!-- Ila kan kharej, nbayno Sign-in -->
                <a href="sign_in.php" class="signin-btn">Sign-in</a>
            <?php endif; ?>
            
          </div>
        </div>
      </div>
    </header>