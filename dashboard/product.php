<?php
// Database connection parameters
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "efm";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch product data from the 'produit' table
$sqlProducts = "SELECT id_Produit, libelle_Produit, product_name, Description_Produit, prix_de_vente, image FROM produit";
$resultProducts = mysqli_query($conn, $sqlProducts);

// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products Dashboard</title>
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar -->
    <link rel="stylesheet" href="../css/product.css"> <!-- For specific product table styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-top">
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo">
                </div>
                <ul class="nav-links">
                    <li>
                        <a href="../dashboard/statistics.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Statistique</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard/users.php">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-box-open"></i>
                            <span>Product</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-bottom">
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

        <main class="content">
            <h1 class="title">Product Management</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultProducts) > 0) {
                            while ($row = mysqli_fetch_assoc($resultProducts)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id_Produit']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['libelle_Produit']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Description_Produit']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['prix_de_vente']) . "</td>";
                                echo "<td><img src='../images/" . htmlspecialchars($row['image']) . "' alt='Product Image' style='width: 50px; height: auto;'></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No products found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>