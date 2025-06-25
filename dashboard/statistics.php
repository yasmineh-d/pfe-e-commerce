<?php
// --- START PHP ---

// Database connection parameters (REPLACE WITH YOUR ACTUAL CREDENTIALS)
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "efm";

// Initialize counts to 0 in case of errors or no data
$totalOrders = 0;
$totalProducts = 0;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    // For debugging, you might want to see the error:
    // die("Connection failed: " . mysqli_connect_error());
    // For production, you might just log it and show 0s or a generic error message
    // For this example, we'll let it show 0s if connection fails.
} else {
    // --- Get Total Orders ---
    // Get Total Orders
    $sqlOrders = "SELECT COUNT(*) as order_count FROM commande"; // Assuming 'commande' is the orders table
    $resultOrders = mysqli_query($conn, $sqlOrders);

    if ($resultOrders) {
        $rowOrders = mysqli_fetch_assoc($resultOrders);
        $totalOrders = $rowOrders['order_count'];
    } else {
        // Optional: Log error if query fails
        // error_log("Error fetching total orders: " . mysqli_error($conn));
    }

    // --- Get Total Products ---
    // Get Total Products
    $sqlProducts = "SELECT COUNT(*) as product_count FROM produit"; // Assuming 'produit' is the products table
    $resultProducts = mysqli_query($conn, $sqlProducts);

    if ($resultProducts) {
        $rowProducts = mysqli_fetch_assoc($resultProducts);
        $totalProducts = $rowProducts['product_count'];
    } else {
        // Optional: Log error if query fails
        // error_log("Error fetching total products: " . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
}

// --- END PHP ---
?>
<!DOCTYPE html> <!-- Specifies the document type to be HTML5 -->
<html lang="en"> <!-- Root element of an HTML page, language set to English -->

<head>
    <!-- ======================================================= -->
    <!--                 META TAGS AND LINKS                     -->
    <!-- ======================================================= -->
    <meta charset="UTF-8" /> <!-- Specifies the character encoding for the document (UTF-8 for universal character support) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Configures the viewport for responsiveness across devices -->
    <title>Dashboard</title> <!-- The title of the document, displayed in the browser's title bar or tab -->

    <link rel="stylesheet" href="../css/statistics.css"> <!-- Link to your custom CSS file -->
    <!-- Font Awesome CDN (Added to display icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- ======================================================= -->
    <!--                 MAIN PAGE CONTAINER                     -->
    <!-- ======================================================= -->
    <div class="container">

        <!-- ======================================================= -->
        <!--                      SIDEBAR NAVIGATION                 -->
        <!-- ======================================================= -->
        <nav class="sidebar">
            <!-- --- Top section of the sidebar --- -->
            <div class="sidebar-top">
                <!-- Logo section -->
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo">
                </div>
                <!-- Main navigation links -->
                <ul class="nav-links">
                    <li class="active"> <!-- Active navigation item -->
                        <a href="#">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Statistique</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/user.php">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/product.php">
                            <i class="fas fa-box-open"></i>
                            <span>Product</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- --- Bottom section of the sidebar --- -->
            <div class="sidebar-bottom">
                <!-- Secondary navigation links (settings, log out) -->
                <ul class="nav-links">
                    <li>
                        <a href="../dashboard/settings.php">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/logout.php">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ======================================================= -->
        <!--                    MAIN CONTENT AREA                    -->
        <!-- ======================================================= -->
        <main class="content">
            <!-- Title of the content area -->
            <h1 class="title">Dashboard</h1>
            <!-- Container for statistics cards -->
            <div class="stats-cards">
                <!-- Card for Total Orders -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-file-alt"></i> <!-- Orders icon -->
                    </div>
                    <p class="card-label">Total Of Orders</p>
                    <p class="card-value"><?php echo $totalOrders; ?></p>
                </div>
                <!-- Card for Total Product -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-archive"></i> <!-- Product/Archive icon -->
                    </div>
                    <p class="card-label">Total Of Product</p>
                    <p class="card-value"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>