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

// Fetch user data
$sqlUsers = "SELECT email, nom, telephone, password FROM utilisateur";
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
    <link rel="stylesheet" href="../css/statistics.css"> <!-- Reusing statistics.css for sidebar styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
        /* Specific styles for the users table */
        .users-table-container {
            background-color: var(--content-bg);
            padding: 20px;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow-x: auto; /* Ensures table is scrollable on small screens */
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .users-table th,
        .users-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        .users-table th {
            background-color: #f2f2f2;
            font-weight: 600;
            color: var(--title-text);
        }

        .users-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .users-table tr:hover {
            background-color: #f1f1f1;
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
                            <th>Email</th>
                            <th>Nom</th>
                            <th>Telephone</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultUsers) > 0) {
                            while ($row = mysqli_fetch_assoc($resultUsers)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
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