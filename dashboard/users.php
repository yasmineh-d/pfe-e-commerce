<?php
// This PHP block handles database connection and data fetching for user management.

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

// SQL query to fetch user data from the 'client' table
// Selects name, email, telephone, and password
$sqlUsers = "SELECT nom, email, telephone, password FROM client";
$resultUsers = mysqli_query($conn, $sqlUsers); // Execute the query

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users Dashboard</title>

    <!-- External CSS links -->
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar styling -->
    <link rel="stylesheet" href="../css/users.css"> <!-- For specific user table styling -->
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
                    <li class="active"> <!-- Active navigation item for the current page (Users) -->
                        <a href="#">
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
            <h1 class="title">Users Management</h1> <!-- Title of the content area -->
            <!-- Container for the users table -->
            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are any users returned from the query
                        if (mysqli_num_rows($resultUsers) > 0) {
                            // Loop through each row of user data
                            while ($row = mysqli_fetch_assoc($resultUsers)) {
                                echo "<tr>"; // Start a new table row
                                echo "<td data-label='Name'>" . htmlspecialchars($row['nom']) . "</td>"; // User's Name
                                echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>"; // User's Email
                                echo "<td data-label='Telephone'>" . htmlspecialchars($row['telephone']) . "</td>"; // User's Telephone
                                echo "<td data-label='Password'>" . htmlspecialchars($row['password']) . "</td>"; // User's Password
                                echo "</tr>"; // End the table row
                            }
                        } else {
                            // If no users are found, display a message
                            echo "<tr><td colspan='4'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>