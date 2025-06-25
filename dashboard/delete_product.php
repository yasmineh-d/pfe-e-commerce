<?php
// This file handles the deletion of a product from the database.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

// Check if product ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare a DELETE statement to prevent SQL injection
    $sqlDelete = "DELETE FROM produit WHERE id_Produit = ?";
    $stmt = mysqli_prepare($conn, $sqlDelete);

    if ($stmt) {
        // Bind the product ID parameter
        mysqli_stmt_bind_param($stmt, "i", $productId); // "i" for integer type

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If deletion is successful, redirect back to the product list page
            header("Location: product.php?status=deleted");
            exit();
        } else {
            // If execution fails, log the error and redirect with an error status
            error_log("Error deleting product: " . mysqli_error($conn));
            header("Location: product.php?status=delete_failed");
            exit();
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If statement preparation fails, log the error and redirect with an error status
        error_log("Error preparing delete statement: " . mysqli_error($conn));
        header("Location: product.php?status=prepare_failed");
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If no product ID is provided, redirect back to the product list page with an error
    header("Location: product.php?status=no_id");
    exit();
}
?>