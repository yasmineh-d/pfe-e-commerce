<?php
<?php
session_start(); // Darouri nbda session bach n3arfou wach m-loggi wla la

// HNA L'KHADMA L'MOHIMA: Tcheckiw wach m-loggi
// Ila l'variable 'admin_logged_in' ma kaynach awla la valeur dialha ماشي true
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Sifto l page dial login
    header('Location: login.php');
    exit; // W9ef l'execution dial l'code hna bach maykemelch
}

// L'code l'9dim dialk ghaybda men hna
// This PHP block handles database connection...
// ... (kolchi l'code l'ba9i dialk kayji hna)

?>
// This PHP block handles database connection and data fetching for dashboard statistics.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

// Initialize counts to 0 in case of errors or no data
$totalClients = 0;  // Variable to store total number of clients
$totalOrders = 0;   // Variable to store total number of orders
$totalProducts = 0; // Variable to store total number of products

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    // If connection fails, log the error (for debugging) and proceed with 0s for counts
    error_log("Connection failed: " . mysqli_connect_error());
} else {
    // --- Get Total Clients ---
    // SQL query to count all entries in the 'utilisateur' table (assuming it stores client data)
    $sqlClients = "SELECT COUNT(*) as client_count FROM utilisateur";
    $resultClients = mysqli_query($conn, $sqlClients); // Execute the query

    if ($resultClients) {
        $rowClients = mysqli_fetch_assoc($resultClients);
        $totalClients = $rowClients['client_count']; // Store the fetched client count
    } else {
        // Log error if query fails
        error_log("Error fetching total clients: " . mysqli_error($conn));
    }

    // --- Get Total Orders ---
    // SQL query to count all entries in the 'commande' table (assuming it stores order data)
    $sqlOrders = "SELECT COUNT(*) as order_count FROM commande";
    $resultOrders = mysqli_query($conn, $sqlOrders); // Execute the query

    if ($resultOrders) {
        $rowOrders = mysqli_fetch_assoc($resultOrders);
        $totalOrders = $rowOrders['order_count']; // Store the fetched order count
    } else {
        // Log error if query fails
        error_log("Error fetching total orders: " . mysqli_error($conn));
    }

    // --- Get Total Products ---
    // SQL query to count all entries in the 'produit' table (assuming it stores product data)
    $sqlProducts = "SELECT COUNT(*) as product_count FROM produit";
    $resultProducts = mysqli_query($conn, $sqlProducts); // Execute the query

    if ($resultProducts) {
        $rowProducts = mysqli_fetch_assoc($resultProducts);
        $totalProducts = $rowProducts['product_count']; // Store the fetched product count
    } else {
        // Log error if query fails
        error_log("Error fetching total products: " . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ======================================================= -->
    <!--                 META TAGS AND LINKS                     -->
    <!-- ======================================================= -->
    <meta charset="UTF-8" /> <!-- Specifies the character encoding for the document (UTF-8 for universal character support) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Configures the viewport for responsiveness across devices -->
    <title>Dashboard</title> <!-- The title of the document, displayed in the browser's title bar or tab -->

    <link rel="stylesheet" href="../css/statistics.css"> <!-- Link to your custom CSS file for dashboard styling -->
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
                    <img src="../images/logo_Y.png" alt="logo"> <!-- Logo image for the dashboard -->
                </div>
                <!-- Main navigation links -->
                <ul class="nav-links">
                    <li class="active"> <!-- Active navigation item for the current page (Statistics) -->
                        <a href="../dashboard/statistics.php">
                            <i class="fas fa-tachometer-alt"></i> <!-- Icon for Dashboard/Statistique -->
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
            <!-- --- Bottom section of the sidebar --- -->
            <div class="sidebar-bottom">
                <!-- Secondary navigation links (settings, log out) -->
                <ul class="nav-links">
                    <li>
                        <a href="../dashboard/settings.php">
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

        <!-- ======================================================= -->
        <!--                    MAIN CONTENT AREA                    -->
        <!-- ======================================================= -->
        <main class="content">
            <!-- Title of the content area -->
            <h1 class="title">Dashboard</h1>
            <!-- Container for statistics cards -->
            <div class="stats-cards">
                <!-- Card for Total Clients -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i> <!-- Clients icon -->
                    </div>
                    <p class="card-label">Total Of Clients</p>
                    <p class="card-value"><?php echo $totalClients; ?></p> <!-- Displays the total number of clients -->
                </div>
                <!-- Card for Total Orders -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-file-alt"></i> <!-- Orders icon -->
                    </div>
                    <p class="card-label">Total Of Orders</p>
                    <p class="card-value"><?php echo $totalOrders; ?></p> <!-- Displays the total number of orders -->
                </div>
                <!-- Card for Total Product -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-archive"></i> <!-- Product/Archive icon -->
                    </div>
                    <p class="card-label">Total Of Product</p>
                    <p class="card-value"><?php echo $totalProducts; ?></p> <!-- Displays the total number of products -->
                </div>
            </div>
        </main>
    </div>
</body>

</html>