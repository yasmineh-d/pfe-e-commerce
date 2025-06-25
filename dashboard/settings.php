<?php
session_start(); // Important for managing login state

// Tchecki wach l'admin m-loggi. Ila la, sardo l page dial login.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Sardo l login
    exit;
}


// Database connection parameters
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "efm";

$adminEmail = '';
$adminName = '';
$updateMessage = ''; // Bch n'affichiw les messages hna

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch current admin details from 'client' table.
// Hna, ghadi njiboh b l'ID aw l'email li stockina f session melli dar login.
// Walakin bima anana yallah bdayna, ghadi nfar9o kayn admin we7ed.
$sqlFetchAdmin = "SELECT email, nom FROM client WHERE email = 'admin@example.com' LIMIT 1";
$resultAdmin = mysqli_query($conn, $sqlFetchAdmin);

if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
    $adminData = mysqli_fetch_assoc($resultAdmin);
    $adminEmail = htmlspecialchars($adminData['email']);
    $adminName = htmlspecialchars($adminData['nom']);
} else {
    // If admin not found, you should probably handle this as a critical error.
    error_log("Admin user (admin@example.com) not found.");
    $adminEmail = 'admin@example.com';
    $adminName = 'Admin Not Found';
}


// Handle form submission for updating admin details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldEmail = $_POST['old_admin_email']; // Kanakhdo l'email l9dim bach n3arfo chkoun ghadi nbedlo
    $newEmail = $_POST['admin_email'];
    $newName = $_POST['admin_name'];
    $newPassword = $_POST['admin_password']; // Hada howa l'mot de passe l'jdid

    $paramsToBind = [$newEmail, $newName];
    $types = "ss";

    // Ghadi nbedlo l'mot de passe GHI ILA l'user kteb chi 7aja f l'input.
    if (!empty($newPassword)) {
        // Hash the new password! Hada howa l'mohim!
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sqlUpdateAdmin = "UPDATE client SET email = ?, nom = ?, password = ? WHERE email = ?";
        $paramsToBind[] = $hashedPassword;
        $paramsToBind[] = $oldEmail;
        $types = "ssss";
    } else {
        // Ila maktebch mot de passe jdid, ghadi nbedlo ghir l'email w smiya.
        $sqlUpdateAdmin = "UPDATE client SET email = ?, nom = ? WHERE email = ?";
        $paramsToBind[] = $oldEmail;
        $types = "sss";
    }

    $stmtUpdate = mysqli_prepare($conn, $sqlUpdateAdmin);

    if ($stmtUpdate) {
        // mysqli_stmt_bind_param tekheles min le nombre d'arguments
        mysqli_stmt_bind_param($stmtUpdate, $types, ...$paramsToBind);

        if (mysqli_stmt_execute($stmtUpdate)) {
            $adminEmail = htmlspecialchars($newEmail);
            $adminName = htmlspecialchars($newName);
            $updateMessage = "<p style='color: green; text-align: center;'>Settings updated successfully!</p>";
        } else {
            error_log("Error updating admin settings: " . mysqli_error($conn));
            $updateMessage = "<p style='color: red; text-align: center;'>Error updating settings.</p>";
        }
        mysqli_stmt_close($stmtUpdate);
    } else {
        error_log("Error preparing update statement: " . mysqli_error($conn));
        $updateMessage = "<p style='color: red; text-align: center;'>Error preparing update statement.</p>";
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings Dashboard</title>
    <link rel="stylesheet" href="../css/statistics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .settings-content { background-color: var(--content-bg); padding: 30px; border-radius: var(--card-border-radius); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); max-width: 600px; margin: 30px auto; }
        .settings-content h2 { color: var(--title-text); margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--card-label-text); }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .form-actions { text-align: center; margin-top: 30px; }
        .form-actions button { background-color: #007bff; color: white; padding: 10px 25px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; }
        .form-actions button:hover { background-color: #0056b3; }
        .password-note { font-size: 12px; color: #777; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <!-- Sidebar content remains the same... -->
        </nav>
        <main class="content">
            <h1 class="title">Settings</h1>
            <?php echo $updateMessage; // Afficher le message ici ?>
            <div class="settings-content">
                <h2>Admin Account Settings</h2>
                <form action="settings.php" method="POST">
                    <input type="hidden" name="old_admin_email" value="<?php echo $adminEmail; ?>">

                    <div class="form-group">
                        <label for="admin_name">Admin Name:</label>
                        <input type="text" id="admin_name" name="admin_name" value="<?php echo $adminName; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="admin_email">Admin Email:</label>
                        <input type="email" id="admin_email" name="admin_email" value="<?php echo $adminEmail; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="admin_password">New Password:</label>
                        <input type="password" id="admin_password" name="admin_password" value="" />
                        <p class="password-note">Leave blank if you don't want to change the password.</p>
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