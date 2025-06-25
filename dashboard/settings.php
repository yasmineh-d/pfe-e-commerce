<?php
// This file is for dashboard settings.
// You can add PHP logic here to handle settings updates,
// fetch current settings from a database, etc.

// Example: If a form is submitted to update settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    // e.g., save settings to a database
    // header("Location: settings.php?status=success");
    // exit();
}

// You might fetch settings from a database here to pre-fill forms
// $setting1 = "value1";
// $setting2 = "value2";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings Dashboard</title>

    <!-- External CSS links -->
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar styling -->
    <!-- You might add a specific settings.css here if needed -->
    <!-- <link rel="stylesheet" href="../css/settings.css"> -->

    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Main page container -->
    <div class="container">
        <!-- Sidebar navigation -->
        <nav class="sidebar">
            <!-- Top section of the sidebar (logo and main navigation links) -->
            <div class="sidebar-top">
                <!-- Logo section -->
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo"> <!-- Company logo -->
                </div>
                <!-- Main navigation links -->
                <ul class="nav-links">
                    <li>
                        <a href="../dashboard/statistics.php">
                            <i class="fas fa-tachometer-alt"></i> <!-- Icon for Statistics -->
                            <span>Statistique</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/users.php">
                            <i class="fas fa-users"></i> <!-- Icon for Users -->
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/product.php">
                            <i class="fas fa-box-open"></i> <!-- Icon for Product -->
                            <span>Product</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Bottom section of the sidebar (settings and log out links) -->
            <div class="sidebar-bottom">
                <ul class="nav-links">
                    <li class="active"> <!-- Active navigation item for Settings page -->
                        <a href="#">
                            <i class="fas fa-cog"></i> <!-- Icon for Settings -->
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/logout.php">
                            <i class="fas fa-sign-out-alt"></i> <!-- Icon for Log out -->
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content area -->
        <main class="content">
            <h1 class="title">Settings</h1> <!-- Title of the content area -->
            <div class="settings-content">
                <p>This is the settings page. You can add various configuration options here.</p>
                <!-- Example form for settings -->
                <form action="settings.php" method="POST">
                    <label for="site_name">Site Name:</label>
                    <input type="text" id="site_name" name="site_name" value="Homelectronique" /><br /><br />

                    <label for="admin_email">Admin Email:</label>
                    <input type="email" id="admin_email" name="admin_email" value="admin@example.com" /><br /><br />

                    <button type="submit">Save Settings</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>