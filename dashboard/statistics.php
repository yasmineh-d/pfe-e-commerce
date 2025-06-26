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

session_start();

// Protection: Checki wach l'admin m-loggi.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Database connection parameters
$servername = "localhost";
$username   = "root";
$password_db_conn   = ""; // Database connection password
$dbname     = "efm";

// Create database connection
$conn = mysqli_connect($servername, $username, $password_db_conn, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ------ Fetch data for Stat Cards ------
$totalClients = 0;
$totalOrders = 0;
$totalProducts = 0;

// Get total clients
$sqlClients = "SELECT COUNT(*) as count FROM client";
$resultClients = mysqli_query($conn, $sqlClients);
if ($resultClients) {
    $rowClients = mysqli_fetch_assoc($resultClients);
    $totalClients = $rowClients['count'];
} else {
    // Optional: Log an error if query fails
    error_log("Error fetching client count: " . mysqli_error($conn));
}

// Get total orders (ADJUST 'commande' IF YOUR TABLE NAME IS DIFFERENT)
$sqlOrders = "SELECT COUNT(*) as count FROM commande"; // <<< CHANGE 'commande' IF NEEDED
$resultOrders = mysqli_query($conn, $sqlOrders);
if ($resultOrders) {
    $rowOrders = mysqli_fetch_assoc($resultOrders);
    $totalOrders = $rowOrders['count'];
} else {
    error_log("Error fetching order count: " . mysqli_error($conn));
}

// Get total products (ADJUST 'produit' IF YOUR TABLE NAME IS DIFFERENT)
$sqlProducts = "SELECT COUNT(*) as count FROM produit"; // <<< CHANGE 'produit' IF NEEDED
$resultProducts = mysqli_query($conn, $sqlProducts);
if ($resultProducts) {
    $rowProducts = mysqli_fetch_assoc($resultProducts);
    $totalProducts = $rowProducts['count'];
} else {
    error_log("Error fetching product count: " . mysqli_error($conn));
}
// ------ End Fetch data for Stat Cards ------

mysqli_close($conn);

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

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Statistics</title>
    <link rel="stylesheet" href="../css/statistics.css"> <!-- Your main dashboard CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
        /* Styles for Stat Cards (can be moved to statistics.css if preferred) */
        .stat-cards-container {
            display: flex;
            justify-content: space-around;
            /* Distributes space around items */
            flex-wrap: wrap;
            /* Allows cards to wrap to next line on smaller screens */
            gap: 25px;
            /* Space between cards */
            padding: 20px 10px;
            /* Padding around the container of cards */
            margin-top: 20px;
            /* Space above the cards */
        }

        .stat-card {
            background-color: #fff;
            /* White background for cards */
            border-radius: 15px;
            /* Rounded corners like in the image */
            padding: 25px 20px;
            /* Padding inside cards */
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.09);
            /* Slightly more pronounced shadow */
            flex-grow: 1;
            /* Allow cards to grow to fill space */
            flex-basis: 260px;
            /* Base width before growing/shrinking */
            max-width: 320px;
            /* Max width for a card */
            box-sizing: border-box;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card .card-icon {
            font-size: 3em;
            /* Icon size */
            color: #ffc107;
            /* Yellow color for icons, consistent with image */
            margin-bottom: 15px;
        }

        .stat-card .card-title {
            font-size: 1.1em;
            /* Title text size */
            color: #333;
            /* Title color */
            margin-bottom: 12px;
            font-weight: 500;
        }

        .stat-card .card-value {
            font-size: 2.8em;
            /* Large number for the value */
            color: #111;
            /* Value color */
            font-weight: 700;
            /* Bold value */
        }

        /* Responsive adjustments for stat cards */
        @media (max-width: 992px) {

            /* For tablets */
            .stat-cards-container {
                gap: 20px;
            }

            .stat-card {
                flex-basis: calc(50% - 20px);
                /* 2 cards per row, accounting for gap */
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 600px) {

            /* For mobile phones */
            .stat-cards-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .stat-card {
                flex-basis: 85%;
                /* Take up more width when stacked */
                width: 85%;
                max-width: 350px;
            }
        }

        /* Ensure variables like --content-bg, --title-text from statistics.css are used by .container, .content, .title */
    </style>
</head>

<body>
    <div class="container">
        <!-- ====================== SIDEBAR ====================== -->
        <nav class="sidebar">
            <div class="sidebar-top">
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo"> <!-- Make sure this path is correct -->
                </div>
                <ul class="nav-links">
                    <li class="active"> <!-- Statistics page is active -->
                        <a href="statistics.php">
                            <i class="fas fa-tachometer-alt"></i><span>Statistique</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php">
                            <i class="fas fa-users"></i><span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="product.php">
                            <i class="fas fa-box-open"></i><span>Product</span>
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

            <div class="sidebar-bottom">
                <ul class="nav-links">
                    <li>
                        <a href="settings.php">
                            <i class="fas fa-cog"></i><span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt"></i><span>Log out</span>

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
        <!-- =================== MAIN CONTENT ==================== -->
        <main class="content">
            <h1 class="title">Dashboard</h1> <!-- Title for the statistics page -->

            <!-- Stat Cards Section -->
            <div class="stat-cards-container">
                <div class="stat-card">
                    <i class="fas fa-users card-icon"></i>
                    <p class="card-title">Total Of Clients</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalClients); ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-file-invoice card-icon"></i> <!-- Alt: fa-shopping-bag, fa-list-alt -->
                    <p class="card-title">Total Of Orders</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalOrders); ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-box card-icon"></i> <!-- Alt: fa-cubes, fa-archive -->
                    <p class="card-title">Total Of Product</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalProducts); ?></p>
                </div>
            </div>
            <!-- End Stat Cards Section -->

            <!-- You can add more content here if needed, like charts or recent activity -->

        </main>
    </div>
</body>

</html>