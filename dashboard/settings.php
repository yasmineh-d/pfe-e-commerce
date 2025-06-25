<?php
// This file is for dashboard settings, allowing modification of admin details.

// Database connection parameters
$servername = "localhost"; // Database server name
$username   = "root";     // Database username
$password   = "";         // Database password (empty for XAMPP default)
$dbname     = "efm";      // Database name

$adminEmail = '';
$adminName = ''; // Added for admin name
$adminPassword = '';

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch current admin details from 'client' table (assuming 'admin@example.com' is the admin's email)
// This assumption is made because the 'utilisateur' table columns caused an error,
// and the 'client' table contains 'email', 'nom', and 'password'.
$sqlFetchAdmin = "SELECT email, nom, password FROM client WHERE email = 'admin@example.com' LIMIT 1";
$resultAdmin = mysqli_query($conn, $sqlFetchAdmin);

if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
    $adminData = mysqli_fetch_assoc($resultAdmin);
    $adminEmail = htmlspecialchars($adminData['email']);
    $adminName = htmlspecialchars($adminData['nom']); // Fetch admin name
    $adminPassword = htmlspecialchars($adminData['password']); // Note: Storing/displaying plain password is not secure. This is for demonstration.
} else {
    // Handle case where admin user is not found or query fails
    error_log("Admin user (admin@example.com) not found or error fetching admin data: " . mysqli_error($conn));
    // Set default values if admin not found
    $adminEmail = 'admin@example.com';
    $adminName = 'Admin Name'; // Default admin name
    $adminPassword = '';
}

// Handle form submission for updating admin details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Re-establish connection for POST request
    // (This is done because the previous connection might have been closed)
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $oldEmail = $_POST['old_admin_email']; // Hidden field to identify the record to update
    $newEmail = $_POST['admin_email'];
    $newName = $_POST['admin_name']; // New: admin name from form
    $newPassword = $_POST['admin_password']; // In a real application, hash this password!

    // Update admin data in 'client' table
    $sqlUpdateAdmin = "UPDATE client SET email = ?, nom = ?, password = ? WHERE email = ?";
    $stmtUpdate = mysqli_prepare($conn, $sqlUpdateAdmin);

    if ($stmtUpdate) {
        // Bind parameters: "ssss" for string, string, string, string
        mysqli_stmt_bind_param($stmtUpdate, "ssss", $newEmail, $newName, $newPassword, $oldEmail);

        if (mysqli_stmt_execute($stmtUpdate)) {
            // Update successful, refresh displayed data
            $adminEmail = htmlspecialchars($newEmail);
            $adminName = htmlspecialchars($newName);
            $adminPassword = htmlspecialchars($newPassword);
            echo "<p style='color: green; text-align: center;'>Settings updated successfully!</p>";
        } else {
            // Log error if execution fails
            error_log("Error updating admin settings: " . mysqli_error($conn));
            echo "<p style='color: red; text-align: center;'>Error updating settings.</p>";
        }
        mysqli_stmt_close($stmtUpdate); // Close the statement
    } else {
        // Log error if statement preparation fails
        error_log("Error preparing update statement: " . mysqli_error($conn));
        echo "<p style='color: red; text-align: center;'>Error preparing update statement.</p>";
    }

    mysqli_close($conn); // Close the database connection
}
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
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
        /* Specific styles for the settings form */
        .settings-content {
            background-color: var(--content-bg);
            padding: 30px;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 30px auto;
        }

        .settings-content h2 {
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
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
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
                <h2>Admin Account Settings</h2>
                <form action="settings.php" method="POST">
                    <div class="form-group">
                        <label for="admin_email">Admin Email:</label>
                        <input type="email" id="admin_email" name="admin_email" value="<?php echo $adminEmail; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="admin_password">Admin Password:</label>
                        <input type="password" id="admin_password" name="admin_password" value="<?php echo $adminPassword; ?>" required />
                    </div>

                    <div class="form-actions">
                        <button type="submit">Save Settings</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>