<?php
session_start();



// Redirect if already logged in

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: statistics.php');
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // --- Database Connection ---

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "efm";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());

        // Use a generic error message in production for security
        die("Connection failed. Please try again later.");

    }

    $email_input = $_POST['admin_email'];
    $password_input = $_POST['admin_password'];


    $sql = "SELECT id, email, password, profil FROM utilisateur WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    // --- The Fix is Here ---
    // CHANGED: Corrected column names from 'email_utilisateur' to 'email' and 'password_utilisateur' to 'password'.
    // Make sure these match the actual names in your 'utilisateur' table.
    $sql = "SELECT email, password, profil FROM utilisateur WHERE email = ? LIMIT 1";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    // Check if prepare failed
    if ($stmt === false) {
        // This will help you debug if the SQL syntax is wrong for other reasons
        die('MySQL prepare error: ' . mysqli_error($conn));
    }
    

    mysqli_stmt_bind_param($stmt, "s", $email_input);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $adminData = mysqli_fetch_assoc($result);


        if ($adminData['profil'] === 'admin') {
            $hashedPassword_from_db = $adminData['password'];

            if (password_verify($password_input, $hashedPassword_from_db)) {
                // Success!
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $adminData['id'];
                $_SESSION['admin_profil'] = $adminData['profil'];

        // Check if the user's profile is 'admin'
        if ($adminData['profil'] === 'admin') {

            // CHANGED: Use the correct column name 'password' to get the hash from the database
            $hashed_password_from_db = $adminData['password'];

            // Use password_verify for secure password checking
            if (password_verify($password_input, $hashed_password_from_db)) {
                // --- Success! User is authenticated ---
                $_SESSION['admin_logged_in'] = true;
                // You can add an ID to your session if you have an 'id' column in your table.
                // For example: $_SESSION['admin_id'] = $adminData['id']; 
                $_SESSION['admin_profil'] = $adminData['profil'];
                // CHANGED: Use the correct column name 'email' for the session

                $_SESSION['admin_email'] = $adminData['email'];

                header('Location: statistics.php');
                exit;
            } else {

                $errorMessage = "Invalid email or password.";
            }
        } else {
            $errorMessage = "Invalid email or password.";
        }
    } else {
        $errorMessage = "Invalid email or password.";
    }

                // Password does not match
                $errorMessage = "Invalid email or password.";
            }
        } else {
            // User exists but is not an admin
            $errorMessage = "You do not have permission to access this page.";
        }
    } else {
        // No user found with that email
        $errorMessage = "Invalid email or password.";
    }
    mysqli_stmt_close($stmt);

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- CSS code b9a kifma howa -->
    <style>
    body { font-family: 'Roboto', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .login-container { background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
    .login-container h2 { margin-bottom: 25px; color: #333; }
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    .form-actions button { background-color: #007bff; color: white; padding: 12px; width: 100%; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; }
    .form-actions button:hover { background-color: #0056b3; }
    .error-message { color: red; margin-bottom: 15px; }
</style>
    <!-- Your CSS code remains the same -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 25px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-actions button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-actions button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>

</head>
<body>
    <div class="login-container">
        <h2>Admin Panel Login</h2>
        <?php if ($errorMessage): ?>

            <p class="error-message"><?php echo $errorMessage; ?></p>

            <p class="error-message"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></p>

        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="admin_email">Email:</label>
                <input type="email" id="admin_email" name="admin_email" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required>
            </div>
            <div class="form-actions">
                <button type="submit">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>