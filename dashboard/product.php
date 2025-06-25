<?php
// This PHP block handles database connection and data fetching for products.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    // If connection fails, terminate script and display error
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch product data from the 'produit' table
// Selects product ID, libelle, product name, description, selling price, and image
$sqlProducts = "SELECT id_Produit, libelle_Produit, product_name, Description_Produit, prix_de_vente, image FROM produit";
$resultProducts = mysqli_query($conn, $sqlProducts); // Execute the query

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products Dashboard</title>

    <!-- External CSS links -->
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar styling -->
    <link rel="stylesheet" href="../css/product.css"> <!-- For specific product table styling -->
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
                    <li class="active"> <!-- Active navigation item for Product page -->
                        <a href="#">
                            <i class="fas fa-box-open"></i> <!-- Icon for Product -->
                            <span>Product</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Bottom section of the sidebar (settings and log out links) -->
            <div class="sidebar-bottom">
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

        <!-- Main content area -->
        <main class="content">
            <h1 class="title">Product Management</h1> <!-- Title of the content area -->
            <!-- Container for the product table -->
            <div class="product-table-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are any products returned from the query
                        if (mysqli_num_rows($resultProducts) > 0) {
                            // Loop through each row of product data
                            while ($row = mysqli_fetch_assoc($resultProducts)) {
                                echo "<tr>"; // Start a new table row
                                echo "<td data-label='ID'>" . htmlspecialchars($row['id_Produit']) . "</td>"; // Product ID
                                echo "<td data-label='Libelle'>" . htmlspecialchars($row['libelle_Produit']) . "</td>"; // Product Libelle
                                echo "<td data-label='Product Name'>" . htmlspecialchars($row['product_name']) . "</td>"; // Product Name
                                echo "<td data-label='Description'>" . htmlspecialchars($row['Description_Produit']) . "</td>"; // Product Description
                                echo "<td data-label='Price'>" . htmlspecialchars($row['prix_de_vente']) . "</td>"; // Product Price
                                // Product Image, with a fixed width and auto height for display
                                echo "<td data-label='Image'><img src='../images/" . htmlspecialchars($row['image']) . "' alt='Product Image' style='width: 50px; height: auto;'></td>";
                                echo "<td data-label='Actions' class='actions-cell'>"; // Actions column
                                echo "<a href='edit_product.php?id=" . urlencode($row['id_Produit']) . "' class='action-btn edit-btn'><i class='fas fa-edit'></i> Edit</a>";
                                echo "<a href='delete_product.php?id=" . urlencode($row['id_Produit']) . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\");'><i class='fas fa-trash-alt'></i> Delete</a>";
                                echo "</td>";
                                echo "</tr>"; // End the table row
                            }
                        } else {
                            // If no products are found, display a message
                            echo "<tr><td colspan='7'>No products found.</td></tr>"; // colspan changed to 7
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="add-button-container">
                <a href="add_product.php" class="add-btn"><i class="fas fa-plus-circle"></i> Add New Product</a>
            </div>
        </main>
    </div>
</body>

</html>