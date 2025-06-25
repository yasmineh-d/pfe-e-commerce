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

// Fetch user data from the 'client' table
$sqlUsers = "SELECT nom, email, telephone, password FROM client";
$resultUsers = mysqli_query($conn, $sqlUsers);

// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="../css/statistics.css"> <!-- For general dashboard layout and sidebar -->
    <link rel="stylesheet" href="../css/users.css"> <!-- For specific user table styling -->
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
                    <li class="active">
                        <a href="#">
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
            <h1 class="title">Users Management</h1>
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
                        if (mysqli_num_rows($resultUsers) > 0) {
                            while ($row = mysqli_fetch_assoc($resultUsers)) {
                                echo "<tr>";
                                echo "<td data-label='Name'>" . htmlspecialchars($row['nom']) . "</td>";
                                echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td data-label='Telephone'>" . htmlspecialchars($row['telephone']) . "</td>";
                                echo "<td data-label='Password'>" . htmlspecialchars($row['password']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
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