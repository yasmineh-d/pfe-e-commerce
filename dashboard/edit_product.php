<?php
// This file handles the editing of a product in the database.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

$product = null; // Initialize product variable

// Check if product ID is provided in the URL for fetching data
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch product data for the given ID
    $sqlFetch = "SELECT id_Produit, libelle_Produit, product_name, Description_Produit, prix_de_vente, image FROM produit WHERE id_Produit = ?";
    $stmtFetch = mysqli_prepare($conn, $sqlFetch);

    if ($stmtFetch) {
        mysqli_stmt_bind_param($stmtFetch, "i", $productId);
        mysqli_stmt_execute($stmtFetch);
        $resultFetch = mysqli_stmt_get_result($stmtFetch);

        if (mysqli_num_rows($resultFetch) > 0) {
            $product = mysqli_fetch_assoc($resultFetch);
        } else {
            echo "Product not found.";
            exit();
        }
        mysqli_stmt_close($stmtFetch);
    } else {
        error_log("Error preparing fetch statement: " . mysqli_error($conn));
        echo "Error fetching product data.";
        exit();
    }

    mysqli_close($conn);
}

// Handle form submission for updating product data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Re-establish connection for POST request
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $productId = $_POST['id_Produit'];
    $libelle = $_POST['libelle_Produit'];
    $productName = $_POST['product_name'];
    $description = $_POST['Description_Produit'];
    $price = $_POST['prix_de_vente'];
    $image = $_POST['current_image']; // Keep current image if not updated

    // Handle image upload if a new file is provided
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
                $image = basename($_FILES["image"]["name"]); // Update image name in DB
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update product data
    $sqlUpdate = "UPDATE produit SET libelle_Produit = ?, product_name = ?, Description_Produit = ?, prix_de_vente = ?, image = ? WHERE id_Produit = ?";
    $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);

    if ($stmtUpdate) {
        mysqli_stmt_bind_param($stmtUpdate, "sssdsi", $libelle, $productName, $description, $price, $image, $productId); // "sssdsi" for string, string, string, double, string, integer

        if (mysqli_stmt_execute($stmtUpdate)) {
            header("Location: product.php?status=updated");
            exit();
        } else {
            error_log("Error updating product: " . mysqli_error($conn));
            echo "Error updating product.";
        }
        mysqli_stmt_close($stmtUpdate);
    } else {
        error_log("Error preparing update statement: " . mysqli_error($conn));
        echo "Error preparing update statement.";
    }

    mysqli_close($conn);
}

// If product data was not fetched (e.g., no ID provided or product not found), redirect
if ($product === null && !isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/statistics.css">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
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
        .form-group textarea {
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

        .current-image-preview {
            margin-top: 10px;
            text-align: center;
        }

        .current-image-preview img {
            max-width: 150px;
            height: auto;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 5px;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .form-actions button {
            background-color: #007bff;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-actions button:hover {
            background-color: #0056b3;
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
                        <a href="../dashboard/product.php">
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
            <h1 class="title">Edit Product</h1>
            <div class="form-container">
                <h2>Edit Product Details</h2>
                <?php if ($product) : ?>
                    <form action="edit_product.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_Produit" value="<?php echo htmlspecialchars($product['id_Produit']); ?>">
                        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">

                        <div class="form-group">
                            <label for="libelle_Produit">Libelle:</label>
                            <input type="text" id="libelle_Produit" name="libelle_Produit" value="<?php echo htmlspecialchars($product['libelle_Produit']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="Description_Produit">Description:</label>
                            <textarea id="Description_Produit" name="Description_Produit" required><?php echo htmlspecialchars($product['Description_Produit']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="prix_de_vente">Price:</label>
                            <input type="number" id="prix_de_vente" name="prix_de_vente" step="0.01" value="<?php echo htmlspecialchars($product['prix_de_vente']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Product Image:</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            <div class="current-image-preview">
                                <p>Current Image:</p>
                                <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="Current Product Image">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit">Update Product</button>
                            <a href="product.php" class="action-btn cancel-btn">Cancel</a>
                        </div>
                    </form>
                <?php else : ?>
                    <p>Product data could not be loaded. Please go back to the <a href="product.php">Product List</a>.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>