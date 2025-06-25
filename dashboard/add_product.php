<?php
// This file handles adding a new product to the database.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

// Handle form submission for adding new product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $libelle = $_POST['libelle_Produit'];
    $productName = $_POST['product_name'];
    $description = $_POST['Description_Produit'];
    $price = $_POST['prix_de_vente'];
    $categoryId = $_POST['id_Categories']; // Assuming you'll add a category selection

    $image = ''; // Initialize image variable

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../images/"; // Directory where images are stored
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (e.g., 5MB limit)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
            echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image = basename($_FILES["image"]["name"]); // Store only the filename
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Prepare an INSERT statement to prevent SQL injection
    // Assuming id_Produit is AUTO_INCREMENT and id_Categories is selected from a dropdown
    $sqlInsert = "INSERT INTO produit (libelle_Produit, product_name, Description_Produit, prix_de_vente, image, id_Categories) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsert);

    if ($stmt) {
        // Bind parameters: "sssdsi" for string, string, string, double, string, integer
        mysqli_stmt_bind_param($stmt, "sssdsi", $libelle, $productName, $description, $price, $image, $categoryId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If insertion is successful, redirect back to the product list page
            header("Location: product.php?status=added");
            exit();
        } else {
            // If execution fails, log the error and redirect with an error status
            error_log("Error adding product: " . mysqli_error($conn));
            echo "Error adding product.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If statement preparation fails, log the error and redirect with an error status
        error_log("Error preparing insert statement: " . mysqli_error($conn));
        echo "Error preparing insert statement.";
    }

    // Close the database connection
    mysqli_close($conn);
}

// Fetch categories for the dropdown
$conn = mysqli_connect($servername, $username, $password, $dbname);
$categories = [];
if ($conn) {
    $sqlCategories = "SELECT id_Categories, libelle_Categories FROM categories";
    $resultCategories = mysqli_query($conn, $sqlCategories);
    if ($resultCategories) {
        while ($row = mysqli_fetch_assoc($resultCategories)) {
            $categories[] = $row;
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Product</title>

    <!-- External CSS links -->
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar styling -->
    <link rel="stylesheet" href="../css/product.css"> <!-- For specific product table styling (reusing some styles) -->
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
        /* Specific styles for the add product form */
        .form-container {
            background-color: var(--content-bg);
            padding: 30px;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 30px auto;
        }

        .form-container h2 {
            color: var(--title-text);
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--card-label-text);
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Include padding in element's total width and height */
        }

        .form-group textarea {
            resize: vertical; /* Allow vertical resizing */
            min-height: 80px;
        }

        .form-group input[type="file"] {
            padding: 5px 0;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .form-actions button {
            background-color: #28a745; /* Green for add */
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-actions button:hover {
            background-color: #218838;
        }

        .form-actions .cancel-btn {
            background-color: #6c757d;
            margin-left: 15px;
        }

        .form-actions .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
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
            <h1 class="title">Add New Product</h1> <!-- Title of the content area -->
            <div class="form-container">
                <h2>Enter Product Details</h2>
                <form action="add_product.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="libelle_Produit">Libelle:</label>
                        <input type="text" id="libelle_Produit" name="libelle_Produit" required>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" required>
                    </div>

                    <div class="form-group">
                        <label for="Description_Produit">Description:</label>
                        <textarea id="Description_Produit" name="Description_Produit" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="prix_de_vente">Price:</label>
                        <input type="number" id="prix_de_vente" name="prix_de_vente" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="id_Categories">Category:</label>
                        <select id="id_Categories" name="id_Categories" required>
                            <option value="">Select a Category</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo htmlspecialchars($category['id_Categories']); ?>">
                                    <?php echo htmlspecialchars($category['libelle_Categories']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit">Add Product</button>
                        <a href="product.php" class="action-btn cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>